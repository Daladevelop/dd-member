<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use  \App\User;
use App\Helpers\Helper;
use Bouncer;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{

       public function index()
    {
        $users = User::all();

        return view('users.index')->with(['users' => $users]);
    }


    public function create()
    {
        return view('users.edit')->with(['user' => null]);
    }

    public function store(Request $request)
    {
        $user = new User();

        if (!$user->isValidMemberType($request->member_type))
        {
            Helper::message('Invalid member_type', 'Invalid member_type: ' . $request->member_type, 'danger');
            return redirect()->back();
        }

        $user->fill($request->all());

        $user->member_type = $request->member_type;

        $user->password = bcrypt($request->password);

        if ($request->admin) {
            Bouncer::assign('admin')->to($user);
        } else {
            if (Bouncer::is($user)->a('admin'))
                Bouncer::retract('admin')->from($user);
        }

        $user->save();

        $current_memberfee = \App\MemberFee::Where('year','=',\Carbon\Carbon::now()->year)->first();

        if (isset($current_memberfee)) {
            $payment = new \App\Payment();
            $payment->user_id = $user->id;
            
            switch($user->member_type)
            {
                case "Ordinarie":
                    $payment->amount = $current_memberfee->amount;
                    break;
                case "Student":
                    $payment->amount = $current_memberfee->amount_student;
                    break;
                case "Barn":
                    $payment->amount = $current_memberfee->amount_child;
                    break;
                default:
                    $payment->amount = 0;
                    break;
            }
            
            $current_memberfee->payments()->save($payment);
        }
        Helper::message('Medlem skapad', 'Medlemmen ' . $user->email . ' skapades.', 'success');

        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $user = User::Find($id);
        if (!$user) {
            return redirect()->back();
        }

        return view('users.edit')->with(['user' => $user]);
    }

    public function update($id, Request $request)
    {
        $user = User::Find($id);

        if (!$user->isValidMemberType($request->member_type))
        {
            Helper::message('Invalid member_type', 'Invalid member_type: ' . $request->member_type, 'danger');
            return redirect()->back();
        }

        if (!Auth::user()->can('edit_users')) {

            if (!Auth::user() == $user) {
                return redirect('/');
            }
        } else {
            $user->member_type = $request->member_type;
            if ($request->admin) {
                Bouncer::assign('admin')->to($user);
            } else {
                if (Bouncer::is($user)->a('admin'))
                    Bouncer::retract('admin')->from($user);
            }
        }
           


        if (!$user) {
            return redirect()->back();
        }
        $user->fill($request->all());
        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        } else {
            unset($user->password);
        }


        $user->save();

        return redirect()->back();

    }
}

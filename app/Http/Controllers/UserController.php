<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use  \App\User;
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
        $user->fill($request->all());

        $user->password = bcrypt($request->password);

        if ($request->admin) {
            Bouncer::assign('admin')->to($user);
        } else {
            if (Bouncer::is($user)->a('admin'))
                Bouncer::retract('admin')->from($user);
        }

        $user->save();
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
        if (!Auth::user()->can('edit_users')) {

            if (!Auth::user() == $user) {
                return redirect('/');
            }
        } else {

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

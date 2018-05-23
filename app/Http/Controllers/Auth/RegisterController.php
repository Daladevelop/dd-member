<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Bouncer;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'personal_number' => 'required|string|unique:users',
            'city' => 'required|string',
            'member_type' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'personal_number' => $data['personal_number'],
            'phone' => $data['phone'],
            'city'  => $data['city'],
            'member_type' => $data['member_type']
        ]);
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        Bouncer::assign('member')->to($user);
        if(!\App\Memberfee::has_yearly_fee()){
            Helper::createYearlyFee();
        }
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
    }
}

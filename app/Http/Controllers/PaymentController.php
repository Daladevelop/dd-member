<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Helpers\Helper;
use Bouncer;
use Auth;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        return view('payments.index', ['payments'=>$payments]);
    }

    public function myPayments()
    {
        $payments = Auth::user()->payments;
        return view('payments.index', ['payments' => $payments]);
    }

    public function paymentInstruction($id)
    {
        $payment = Payment::Where(['user_id' => Auth::id(), 'id' => $id, 'payment_date' => null])->first();
        if (!isset($payment))
            return redirect()->route('payments.myPayments');
        
            return view('payments.pay', ['payment'=>$payment]);
    }

    public function pay($id, Request $request)
    {
        $payment = Payment::Where(['user_id' => Auth::id(), 'id' => $id, 'payment_date' => null])->first();
        $payment->payment_date = \Carbon\Carbon::now();
        $payment->save();

        Helper::message('Betalning bekräftad', 'Betalning för evenemang ' . $payment->payable->name . ' bekräftad.', 'success');
        return redirect()->route('payments.myPayments');
    }
}

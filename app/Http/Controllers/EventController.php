<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Helpers\Helper;
use App\Event;
use App\Payment;
use App\Registration;
use Bouncer;
use Illuminate\Support\Facades\Redirect;

/**
 * Class EventController
 * @package App\Http\Controllers
 */
class EventController extends Controller
{

    public function index()
    {
        $events = Event::all();
        $registrations = Auth::user()->registrations;

        return view('events.index')->with(['events' => $events, 'registrations' => $registrations]);
    }

    public function show($id)
    {
        $event = Event::find($id);

        if (!$event)
            return redirect()->back();
        
        return view('events.show')->with(['event' => $event]);
    }


    public function create()
    {
        return view('events.edit')->with(['event' => null]);
    }

    public function store(Request $request)
    {
        $event = new Event();
        $event->fill($request->all());
        if ($event->cost < 0)
            $event->cost = 0;
        if ($event->max_participants < 0)
            $event->max_participants = 0;

        if ($request->members_only) {
            $event->members_only = true;
        } else {
            $event->members_only = false;
        }

        $event->save();
        Helper::message('Event skapat', $event->name.' är nu skapat', 'success');
        return redirect()->route('events.index');
    }

    public function edit($id)
    {
        $event = Event::Find($id);
        if (!$event) {
            return redirect()->back();
        }

        return view('events.edit')->with(['event' => $event]);
    }

    public function update($id, Request $request)
    {
        $event = Event::Find($id);

        if ($request->members_only) {
            $event->members_only = true;
        } else {
            $event->members_only = false;
        }

        if (!$event) {
            return redirect()->back();
        }
        $event->fill($request->all());
        $event->save();
        Helper::message('Event uppdaterat', $event->name.' är nu uppdaterat.', 'success');
        return redirect()->back();

    }

    public function confirmDelete($id, Request $request)
    {
        // Maybe implementing soft deletes instead?
        $event = Event::Find($id);

        return view('events.delete')->with(['event' => $event]);
    }

    public function delete($id, Request $request)
    {
        // Maybe implementing soft deletes instead?
        $event = Event::Find($id);

        // Should check if event exists
        $event->forceDelete();
        Helper::message('Event borttaget', $event->name.' är nu borttaget', 'success');
        return redirect()->route('events.index');
    }

    public function signup($id)
    {
        $event = Event::Find($id);

        //should check if event exists

        if ($event->cost > 0) {
            $payment = new Payment();
            $payment->user_id = Auth::id();
            $payment->amount = $event->cost;
            if ($event->cost == 0)
                $payment->paid_date = Carbon\Carbon::now();
            $event->payments()->save($payment);
        }
        
        // Behövs denna koll??
        if (Registration::Where(['user_id'=>Auth::id(), 'event_id'=>$event->id])->count() > 0) {
            Helper::message('Redan anmäld', 'Du är redan anmäld till evenemangent ' . $event->name, 'warning');
            return redirect()->back();
        }
        $registration = new Registration();
        $registration->event_id = $event->id;
        Auth::user()->registrations()->save($registration);

        Helper::message('Anmäld','Du är nu anmäld till evenemanget ' . $event->name, 'success');
        return redirect()->back();
    }
    public function cancelSignup($id)
    {
        $event = Event::Find($id);

        //should check if event exists

        // Find payment
        $p = Payment::Where(['user_id' => Auth::id(), 'payable_type' => 'App\Event', 'payable_id' => $event->id])->first();
        if ($p)
            $p->forceDelete();
        
        $registration = Registration::Where(['user_id'=>Auth::id(), 'event_id'=>$event->id])->first();
        if (!isset($registration)) {
            Helper::message('Ej anmäld', 'Du är inte anmäld till evenemangent ' . $event->name, 'warning');
            return redirect()->back();
        }
        $registration->forceDelete();
        Helper::message('Anmäld','Du är nu avanmäld från evenemanget ' . $event->name, 'success');
        return redirect()->back();
    }
}

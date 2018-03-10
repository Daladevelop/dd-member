<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Helpers\Helper;
use App\Event;
use Bouncer;

/**
 * Class EventController
 * @package App\Http\Controllers
 */
class EventController extends Controller
{

    public function index()
    {
        $events = Event::all();

        return view('events.index')->with(['events' => $events]);
    }


    public function create()
    {
        return view('events.edit')->with(['event' => null]);
    }

    public function store(Request $request)
    {
        $event = new Event();
        $event->fill($request->all());

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

        $event->forceDelete();
        Helper::message('Event borttaget', $event->name.' är nu borttaget', 'success');
        return redirect()->route('events.index');
    }
}

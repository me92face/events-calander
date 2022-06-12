<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EventsController extends Controller
{
    public function __construct() {

    }

    public function index() {
        $events = Event::query()->where('is_approved', true)->get();
        $events = $events->groupBy(function ($items) {
            return Carbon::parse($items->event_timestamp)->format('Y-m');
        });
        return view('dashboard.home')->with(compact(['events']));
    }

    public function ownEvents() {
        $events = Event::query()->where('created_by', Auth::user()->id)->get();
        return view('dashboard.own-events')->with(compact(['events']));
    }

    public function viewEvent($id) {
        $event = Event::findOrFail($id);
        abort_if(Auth::user()->id != $event->created_by, 403, "Unauthorised access");
        return view('dashboard.event-details')->with(compact(['event']));
    }
    
    public function addNewEvent() {
        return view('dashboard.add-event');
    }

    public function postNewEvent(Request $request) {
        $request->request->add(['training_program_slug' => urlencode(str_replace(' ', '-', strtolower($request->training_program_name)))]);
        $validator = Validator::make($request->all(), [
            'event_name' => 'required|string',
            'event_description' => 'required|string',
            'event_timestamp' => 'required|date',
        ]);
        if ($validator->fails()) {
            return redirect('add-new-event')->withErrors($validator)->withInput();
        } else {
            $validated = $validator->validated();
            $event = new Event();
            $event->event_name = $validated['event_name'];
            $event->event_description = $validated['event_description'];
            $event->event_timestamp = $validated['event_timestamp'];
            if (Auth::user()->role === 'admin') $event->is_approved = true;
            if ($event->save())
                return redirect('my-events')->with('successMessage', '');
            else 
                return redirect('add-new-event')->with('alertMessage', 'Something went wrong. Please try again')->withInput();
        }
    }

    public function editEvent($id) {
        $event = Event::findOrFail($id);
        abort_if(Auth::user()->id != $event->created_by, 403, "Unauthorised access");
        $event->event_timestamps = $event->event_timestamp->format('Y-m-d').'T'. $event->event_timestamp->format('H:m:s');
        return view('dashboard.edit-event')->with(compact(['event']));
    }

    public function postEditEvent($id, Request $request) {
        $event = Event::findOrFail($id);
        abort_if(Auth::user()->id != $event->created_by, 403, "Unauthorised access");
        $validator = Validator::make($request->all(), [
            'event_name' => 'required|string',
            'event_description' => 'required|string',
            'event_timestamp' => 'required|date',
        ]);
        if ($validator->fails()) {
            return redirect('add-new-event')->withErrors($validator)->withInput();
        } else {
            $validated = $validator->validated();
            $event->event_name = $validated['event_name'];
            $event->event_description = $validated['event_description'];
            $event->event_timestamp = $validated['event_timestamp'];
            if (Auth::user()->role === 'admin') $event->is_approved = true;
            if ($event->update())
                return redirect('my-events')->with('successMessage', '');
            else
                return redirect('my-events')->with('alertMessage', 'Something went wrong. Please try again');
        }
    }
}

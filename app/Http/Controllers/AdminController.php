<?php

namespace App\Http\Controllers;

use App\Jobs\EventApprovedEmailJob;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct() {

    }

    public function index() {
        $events = Event::all();
        return view('dashboard.admin-home')->with(compact(['events']));
    }

    public function changeEventApproval(Request $request) {
        $event = Event::findOrFail($request->id);
        $event->update(['is_approved' => ($request->status == 'true') ? true : false]);
        if ($request->status == 'true') {
            dispatch(new EventApprovedEmailJob($event->creator->email));
        }
        return response(['status' => true, 'head' => 'Success', 'body' => 'Event status updated successfully'], 200);
    }
    
    public function viewEvent($id) {
        $event = Event::findOrFail($id);
        return view('dashboard.event-details')->with(compact(['event']));
    }
}

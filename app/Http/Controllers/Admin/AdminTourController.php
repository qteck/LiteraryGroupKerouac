<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use Illuminate\Support\Facades\Auth;
use App\Tours;


class AdminTourController extends Controller
{

    function listOfEvents(Tours $events)
    {
       $listOfEvents = $events->orderBy('id','desc')->get();
       $listOfEvents->count = $listOfEvents->count();

        return view('admin.literary-tour.list', compact('listOfEvents'));
    }

    function addEvent(Tours $events)
    {
        return view('admin.literary-tour.add');
    }

    function addEventAction(Request $request)
    {
        $this->validate($request, [
            'title'  => 'required',
            'place'  => 'required',
            'price'  => 'required|numeric',
            'map_url'  => 'required',
            'date_of_event'  => 'required|date',
            'status'  => 'required',
        ]);

        $event = new Tours($request->all()); 
        $state = $event->save();
        
        if ($state) {
            $msg[] = 'Event has been added';
            return back()->withInput()->with('success', 'The event has been added.');
        } else {
            $msg[] = 'Problem has accured. Try it later.';
            return back()->withErrors($msg);
        }
           
    }
}

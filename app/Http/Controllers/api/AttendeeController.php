<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Resources\AttendeeResource;
use App\Http\Resources\EventResource;

class AttendeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Event $event)
    {
        //
        return $event->load('attendees');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    
    public function show(Event $event, Attendee $attendee)
    {
        return new AttendeeResource($event->attendees()->with('user')->find($attendee->id));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendee $attendee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendee $attendee)
    {
        //
    }
}

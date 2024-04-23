<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Http\Resources\AttendeeResource;
use App\Http\Resources\EventResource;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $events = Event::with('user')->with('attendees')->get();
        return EventResource::collection($events);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

            $validatedData = $request->validate([
                'name' => 'required',
                'description' => 'required',
                'date' => 'required|date',
            ]);

            $event = Event::create([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'date' => $validatedData['date'],
            ]);

            return new EventResource($event);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
        return new EventResource($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
        $event->delete();
        return response()->json(['message' => 'Event deleted successfully']);
    }
    /**
     * Get the average number of attendees for the events.
     */

}

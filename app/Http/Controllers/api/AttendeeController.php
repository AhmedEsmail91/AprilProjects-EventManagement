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
    public function __construct() {
        $this->middleware('auth:sanctum')->except('index', 'show');
    }
    public function index(Event $event)
    {
        //
        return AttendeeResource::collection($event->with(['attendees', 'attendees.user'])->get());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Event $event,Request $request)
    {
        $attendee = $event->attendees()->create([
            'user_id' => $request->user()->id
        ]);
        return response()->json(['message' => 'Attendee created successfully', 'attendee' => new AttendeeResource($attendee)]);
    }

    /**
     * Display the specified resource.
     */
    
    public function show(Event $event, Attendee $attendee)
    {
        return new AttendeeResource($attendee);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendee $attendee)
    {
        //
        $attendee->update($request->validate([
            'status' => 'required|in:pending,accepted,rejected'
        ]));
        return response()->json(['message' => 'Attendee updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event,Attendee $attendee)
    {
        $this->authorize('delete-attendee', $event);
        $attendee->delete();
        return response()->json(['message' => 'Attendee deleted successfully']);
    }
}

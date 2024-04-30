<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Traits\CanLoadRelationships;

use App\Models\Event;
use App\Http\Resources\AttendeeResource;
use App\Http\Resources\EventResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EventController extends Controller
{

    use CanLoadRelationships;

    private array $relations = ['user', 'attendees', 'attendees.user'];
    public function __construct()
    {
        // $this->middleware('auth:sanctum')->except('index', 'show');
        // To authorize the resource using policy to check if the user can perform the action,
        // To ensure that each policy method is called when the corresponding controller action is called.
        $this->authorizeResource(Event::class, 'event');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $query = $this->loadRelationships(Event::query());
        return EventResource::collection($query->latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $event = Event::create([
            ...$request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'start_time' => 'required|date',
                'end_time' => 'required|date|after:start_time'
            ]),
            'user_id' => $request->user()->id
        ]);

        return new EventResource($this->loadRelationships($event));
        // return response()->json(["message"=>"Event created successfully"], status:201);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event, Request $request)
    {
        // return new EventResource(
        //     $this->loadRelationships($event)
        // );
        return new EventResource($this->loadRelationships($event));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        // if(Gate::denies('update-event',$event)){
        //     return response()->json(['message' => 'You are not authorized to update this event'],status:403);
        // }
        // or simply use the authorize helper method
        // $this->authorize('update', $event); // cause we use th policie now
        $event->update(
            $request->validate([
                'name' => 'sometimes|string|max:255',
                'description' => 'nullable|string',
                'start_time' => 'sometimes|date',
                'end_time' => 'sometimes|date|after:start_time'
            ])
        );

        return new EventResource($this->loadRelationships($event));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        // if(!Gate::allows('delete-event',$event)){
        //     return response()->json(['message' => 'You are not authorized to delete this event'],status:403);
        // }
        // $this->authorize('delete', $event);
        $event->delete();
        return response()->json(['message' => 'Event deleted successfully'],status:204);
    }

}

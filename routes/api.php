<?php

use App\Http\Controllers\api\AttendeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Models\Event;
use \App\Http\Controllers\api\EventController;
// use App\Http\Controllers\api\AttendeeController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

# make route for the homelanding page called "/"
Route::get('/', function () {
    return response()->json(['message' => 'Hello World!'], 200);
});

# build the route for the events api resource
Route::apiResource('events', EventController::class);
// build the route for the attendees api resource
Route::apiResource('events.attendees', AttendeeController::class)->scoped(["event"]);

// build the route to get the average number of attendees for each event
// build the route to get the average number of attendees for each event
Route::get('events/average-attendees', [EventController::class, 'averageAttendees']);


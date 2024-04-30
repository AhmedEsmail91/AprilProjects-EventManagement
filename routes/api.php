<?php

use App\Http\Controllers\api\AttendeeController;
use App\Http\Controllers\Api\AuthContoller;
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
    return $request->user()->name;
});

# make route for the homelanding page called "/"
// Route::get('/', function () {
//     return response()->json(['message' => 'Hello World!'], status:401);
// });
Route::get('/', function () {
    return response()->json(['message' => 'LoggedOut']);
})->name('loggedout.api');

# build the route for the events api resource
Route::apiResource('events', EventController::class);

// build the route for the attendees api resource
Route::apiResource('events.attendees', AttendeeController::class)->scoped();

# make route for the register page called "/register"
Route::post('/register', [AuthContoller::class, 'register']);
# make route for the login page called "/login"
Route::post('/login', [AuthContoller::class, 'login'])->name('login');

# make route for the logout page called "/logout"
/// the middleware is used to check if the user is authenticated or not.
Route::post('/logout', [AuthContoller::class, 'logout'])->middleware('auth:sanctum');



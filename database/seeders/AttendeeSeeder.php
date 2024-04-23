<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attendee;
use App\Models\Event;
use App\Models\User;

class AttendeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $eventCount = Event::count();
        $userCount = User::count();

        $minAttendees = 3;
        $maxAttendees = 10;

        Event::all()->each(function ($event) use ($minAttendees, $maxAttendees, $userCount) {
            $attendeeCount = rand($minAttendees, $maxAttendees);
            
            $users = User::inRandomOrder()->limit($attendeeCount)->get();

            $users->each(function ($user) use ($event) {
            Attendee::factory()->create([
                'event_id' => $event->id,
                'user_id' => $user->id,
            ]);
            });
        });
    }
}

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

        $attendeeCount = rand(1, min(3, $userCount));

        Event::all()->each(function ($event) use ($attendeeCount, $userCount) {
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

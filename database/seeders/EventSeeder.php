<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

        //
        // ...

        public function run(): void
        {
            $users = User::all();

            for ($i = 0; $i < 200; $i++) {
                $user = $users->random();
                Event::factory()->create([
                    'name' => fake()->sentence(3),
                    'description' => fake()->sentence(30),
                    'start_time' => $start_time = fake()->dateTimeBetween(now(), now()->addYear()),
                    'end_time' => fake()->dateTimeBetween($start_time, $start_time->modify("+1 month")),
                    'user_id' => $user->id
                ]);
            }
        }
    }


<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Database\Seeders\EventSeeder;
use Database\Seeders\AttendeeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    \App\Models\User::factory(1000)->create();
    $this->call([
        EventSeeder::class
    ]);
    $this->call([
        AttendeeSeeder::class
    ]);
    }
}

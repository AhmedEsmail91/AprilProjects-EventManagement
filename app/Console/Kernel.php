<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use \App\Console\Commands\SendEventReminders;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Schedule the command to run.
        // $schedule->command('app:send-event-reminders')->everyTenSeconds();
        // $schedule->command(SendEventReminders::class)->everyTenSeconds();
        
        // Saving the output of the command to a file.
        // to save the output of the command to a file, use the following syntax
        // $schedule->command('app:send-event-reminders')->everyTenSeconds()->appendOutputTo('storage/logs/send-event-reminders.log');
        // or use the following syntax
        // $schedule->command(SendEventReminders::class)->everyTenSeconds()->sendOutputTo('storage/logs/send-event-reminders.log');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

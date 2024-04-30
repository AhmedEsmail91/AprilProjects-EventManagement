<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendEventReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    // the following Variable($signature) is the command name that you will run in the terminal, we use prefix app to avoid conflicts with other packages,
    // and to clearify that this command is related to our app
    protected $signature = 'app:send-event-reminders'; 
    

    /**
     * The console command description.
     *
     * @var string
     */
    /**
     * The console command description.
     *
     * @var string Descripe the Command Discription Variable.
     */
    protected $description = 'Sending notifications to attendees for events happening in the next 24 hours.'; // this is the description of the command in case of running php artisan list

    /**
     * Execute the console command.
     */
    public function handle() //responsibe for the logic of the command
    {
        // this is the logic of the command
        // $event=\App\Models\Event::whereMonth('start_time', now()->month())->with('attendees')
        // ->get()
        // ->pluck('attendees.*.user.name');

        /* Or simply use WhereBetween */
        $events=\App\Models\Event::whereBetween('start_time', [now(), now()->addMonths(3)])->get();
        // get the count of the events in the previous time interval
        // $count = $event->count();
        // $eventLabel=Str('events', $count);
        // $this->info("$count $eventLabel found in the next month");
        $counter=0;
        $events->each(
            fn($event)=>$event->attendees->each(
                function($attendees) use ($event,&$counter){
                    $this->info("Sending reminder to {$attendees->user->name}");
                    $attendees->user->notify(new \App\Notifications\EventRemiderNotification($event));
                    if(++$counter>=10)return false;
    }));
        
        // $this->info('Reminder notifications sent successfully!');
    }
}

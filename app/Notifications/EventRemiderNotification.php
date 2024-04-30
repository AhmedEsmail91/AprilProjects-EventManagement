<?php

namespace App\Notifications;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventRemiderNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Event $event) // defining the event to construct the email message.
    // and scoping it with public is used instead of defining the property in the class so it's the same result from different way.
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array // choosing the channel to send the notification, in this case mail.
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage // defining the mail message to be sent.
    {
        return (new MailMessage)

                    ->greeting('Hello!')
                    ->line('Reminder you have an upcoming event'.$this->event->start_date)
                    ->action('Visit our KnowledgeBase', url('http://41.33.207.85/KB'))
                    // ->action('Visit our Event', route('events.show', $this->event->id))
                    ->line("The Event {$this->event->name} starts at {$this->event->start_time}");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array // defining the array representation of the notification.
    {
        return [
            'event_id'=>$this->event->id,
            'event_name'=>$this->event->name,
            'event_start_time'=>$this->event->start_time,
        ];// to be used in the database, and display them on the notification page of the website.
    }
}

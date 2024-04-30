<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::define('update-event',fn(User $user,Event $event)=>$event->user_id===$user->id);
        Gate::define('delete-event',fn(User $user,Event $event)=>$event->user_id===$user->id);

        Gate::define('delete-attendee',fn(User $user,Event $event)=>$event->user_id===$user->id || in_array($user->id,$event->attendees->pluck('user_id')->toArray()));
        // or
        // crate attendee 
        // Gate::define('create-attendee',fn(User $user,Event $event)=>$event->user_id===$user->id);
        //
    }
}

<?php

namespace App\Policies;

use App\Models\Attendee;
use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AttendeePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Attendee $attendee): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        // return $event->user_id != $user->id; // the user can't create an attendee for his own event
        return true;    }

    /**
     * Determine whether the user can update the model.
     */
    // public function update(User $user, Attendee $attendee): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Attendee $attendee): bool
    {
        return $attendee->event->user_id === $user->id || $attendee->user_id === $user->id;
    }

}

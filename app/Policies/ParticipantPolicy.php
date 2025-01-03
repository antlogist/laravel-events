<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ParticipantPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Participant $participant): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Event $event): bool
    {
        return $user->id === $event->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Participant $participant): bool
    {
        return $user->id === $participant->event->user_id || $user->id === $participant->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Participant $participant): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Participant $participant): bool
    {
        return false;
    }
}

<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\Participant;
use App\Models\User;
use App\Policies\EventPolicy;
use App\Policies\ParticipantPolicy;
// use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ProvidersAuthServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('update-event', function (User $user, Event $event) {
            return $user->id === $event->user_id;
        });

        Gate::define('delete-event', function (User $user, Event $event) {
            return $user->id === $event->user_id;
        });

        Gate::define('delete-participant', function (User $user, Event $event, Participant $participant) {
            return $user->id === $event->user_id || $user->id === $participant->user_id;
        });
    }
}

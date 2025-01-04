<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Notifications\EventReminderNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SendEventReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-event-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send events info to participants';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $events  = Event::with('participants.user')->whereBetween('start_time', [now(), now()->addDay()])->get();
        $eventCount = $events->count();
        $eventLabel = Str::plural('event', $eventCount);

        $events->each(fn($event) => $event->participants->each(
            fn($participant) => $participant->user->notify(
                new EventReminderNotification($event)
            )
        ));

        $this->info("Found {$eventCount} {$eventLabel}");
        $this->info("Notification has been sent successfully.");
    }
}

<?php

namespace App\Listeners;

use App\Events\BalanceLowEvent;
use App\Notifications\BalanceLowNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendBalanceLowNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BalanceLowEvent $event): void
    {
        $event->user->notify(new BalanceLowNotification($event->balance));
    }
}

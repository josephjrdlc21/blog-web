<?php

namespace App\Laravel\Listeners;

use App\Laravel\Events\UserPasswordUpdated;
use App\Laravel\Notifications\UserPasswordUpdatedNotification;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class UserPasswordUpdatedListener implements ShouldQueue{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(UserPasswordUpdated $event){
        Mail::to($event->user->email)->send(new UserPasswordUpdatedNotification($event->user, $event->password));
    }
}

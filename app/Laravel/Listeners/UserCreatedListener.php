<?php

namespace App\Laravel\Listeners;

use App\Laravel\Events\UserCreated;
use App\Laravel\Notifications\UserCreatedNotification;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class UserCreatedListener implements ShouldQueue{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(UserCreated $event){
        Mail::to($event->user->email)->send(new UserCreatedNotification($event->user, $event->password));
    }
}

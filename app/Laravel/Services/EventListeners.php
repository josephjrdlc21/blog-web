<?php

namespace App\Laravel\Services;

class EventListeners {
    public static function events() {
        return [
            \App\Laravel\Events\UserCreated::class => [
                \App\Laravel\Listeners\UserCreatedListener::class,
            ],
            \App\Laravel\Events\UserPasswordUpdated::class => [
                \App\Laravel\Listeners\UserPasswordUpdatedListener::class,
            ],
        ];
    }
}
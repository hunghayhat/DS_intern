<?php

namespace App\Providers;

use App\Events\OurExampleEvent;
use App\Listeners\OurExampleListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [

        OurExampleEvent::class => [
            OurExampleListener::class
        ]
        // 'App\Events\SomeEvent' => [
        //     'App\Listeners\SomeListener',
        // ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot()
    {
        //
    }
}

<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
//        'Illuminate\Auth\Events\Attempting' => [
//            'App\Listeners\LogAuthenticationAttempt',
//        ],
//
        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\LogSuccessfulLogin',
        ],
//        'Illuminate\Auth\Events\Logout' => [
//            'App\Listeners\LogSuccessfulLogout',
//        ],
//
//        'Illuminate\Auth\Events\Lockout' => [
//            'App\Listeners\LogLockout',
//        ],

    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

//        $events->listen('LogSuccessfulLogin', function($credit){
//
//            $credit->saving();//your event or model function
//        });

        //
    }
}

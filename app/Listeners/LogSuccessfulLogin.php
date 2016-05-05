<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */

    public function handle(Login $event)
    {
        $steamId = null;

        if($event->user->steamAccount()->getResults()){
            $steamId = $event->user->steamAccount()->getResults()->id;
        }

        $log = new User\LoginsLog(['user_id' => $event->user->id,
            'steam_id' => $steamId]
        );

        $log->save();
    }
}

<?php

namespace App\Listeners;

use App\LoginHistory;
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
        LoginHistory::create([
            'user_id' => $event -> user -> getAuthIdentifier(),
            'remember' => $event -> remember?1:0,
            'login_ip' => \Request::ip(),
        ]);
    }
}

<?php

namespace App\Listeners;

use App\Models\LoginHistory;
use Illuminate\Auth\Events\Login;

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
            'user_agent' => \Request::header('User-Agent', ''),
            'referer' => \Request::header('Referer', ''),
            'connection' => \Request::header('Connection', ''),
            'login_ip' => \Request::ip(),
        ]);
    }
}

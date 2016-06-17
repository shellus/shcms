<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LogicLogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $log_file = storage_path('logs'.DIRECTORY_SEPARATOR.'logic.log');
        $log = new Logger('logic', [new StreamHandler($log_file)]);

        $this -> app -> instance('LogicLog', $log);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

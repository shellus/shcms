<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LogicLogProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $log_name = 'logic_log';
        $log_file = storage_path('logs'.DIRECTORY_SEPARATOR.$log_name.'.log');
        $sqlLogger = new Logger($log_name, [new StreamHandler($log_file)]);
        $this->app->instance('LogicLog', $sqlLogger);

        //use
//        app('LogicLog') -> info('LogicLog::info success!');

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

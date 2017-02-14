<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Illuminate\Database\Events\QueryExecuted;

class LogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootLogicLog();
        $this->bootSqlLog();

    }

    private function bootLogicLog()
    {
        $log_name = 'logic_log';
        $log_file = storage_path('logs' . DIRECTORY_SEPARATOR . $log_name . '.log');
        $sqlLogger = new Logger($log_name, [new StreamHandler($log_file)]);
        $this->app->instance('LogicLog', $sqlLogger);
        //usage: app('LogicLog') -> info('LogicLog::info success!');
    }

    private function bootSqlLog()
    {
        $sqlLogFileName = 'sql';
        switch (config('app.log')) {
            case 'single':
                break;
            case 'daily':
                $sqlLogFileName = $sqlLogFileName . '-' . date('Y-m-d');
                break;
        }
        $sqlLogFileName = storage_path("logs/$sqlLogFileName.log");

        $sqlLogger = new Logger('sql', [new StreamHandler($sqlLogFileName)]);

        $user = \Auth::user();
        if (config('app.log_level') == 'debug') {
            \DB::listen(function (QueryExecuted $event) use ($sqlLogger, $user) {
                $sql = $event->sql;

                foreach ($event->bindings as $binding) {
                    $sql = preg_replace('/\?/i', "'$binding'", $sql, 1);
                }
                $context = ['time' => $event->time];
                if ($user) {
                    $context['user'] = $user->toArray();
                    $context['user_name'] = $user->name;
                }
                $sqlLogger->info($sql, $context);
            });
        }
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

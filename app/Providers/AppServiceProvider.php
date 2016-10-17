<?php

namespace App\Providers;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\ServiceProvider;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $log_file = storage_path('logs'.DIRECTORY_SEPARATOR.'sql.log');
        $sqlLogger = new Logger('logic', [new StreamHandler($log_file)]);

        if (env('APP_DEBUG')){
            \DB::listen(function(QueryExecuted $event)use($sqlLogger) {
                $sql = $event -> sql;
                $bindings = $event -> bindings;
                $time = $event -> time;

                foreach ($bindings as $binding){
                    $sql = preg_replace ('/\?/i', '\'' . $binding . '\'', $sql, 1);
                }
                $log_str = 'sql:' . $sql . " | "
                    . 'time:' . $time . 'ms';
                $sqlLogger -> info($log_str);
            });
        }


        \Carbon\Carbon::setLocale('zh');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

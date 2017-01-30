<?php

namespace App\Providers;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Pagination\Paginator;
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

        \View::addNamespace('admin',resource_path('/views/admin/'));


        $log_file = storage_path('logs'.DIRECTORY_SEPARATOR.'sql.log');
        $sqlLogger = new Logger('sql', [new StreamHandler($log_file)]);

        $user = \Auth::user();
        if (config('app.log_level') == 'debug'){
            \DB::listen(function(QueryExecuted $event)use($sqlLogger, $user) {
                $sql = $event -> sql;
                $bindings = $event -> bindings;
                $time = $event -> time;

                foreach ($bindings as $binding){
                    $sql = preg_replace ('/\?/i', '\'' . $binding . '\'', $sql, 1);
                }
                $context = [
                    'time' => $time,
                ];
                if($user){
                    $context['user_id'] = $user -> id;
                    $context['user_name'] = $user -> name;
                }
                $sqlLogger -> info($sql, $context);
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

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Cache;
use App\SiteConfig;
class SiteConfigLoadProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        // TODO 执行数据库迁移时，此处会报错, 所以不运行在cli模式。
        //SQLSTATE[42S02]: Base table or view not found: 1146 Table 'shcms2.site_configs' doesn't exist
        if(!\App::runningInConsole()){
            $configs = SiteConfig::all();
            foreach ($configs as $config){
                app('config') -> set($config -> type .'.'. $config -> name, $config -> value);
            }
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }
}

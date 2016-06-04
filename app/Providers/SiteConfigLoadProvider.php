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
        $configs = SiteConfig::all();
//        $configs = Cache::get('configs_all', function() {
//            return SiteConfig::all();
//        });
        foreach ($configs as $config){
            app('config') -> set($config -> type .'.'. $config -> name, $config -> value);
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

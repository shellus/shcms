<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Cache;
use App\SiteConfig;

/**
 * Class SiteConfigLoadProvider
 * @package App\Providers
 * 载入site_configs表中的配置，并合并到laravel config中
 */
class SiteConfigLoadProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        if(env('DB_CONFIG', false) && \Schema::hasTable('site_configs')){
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

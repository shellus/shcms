<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 设置Admin模块使用的模板路径
        // usage: return view('admin::index');
        \View::addNamespace('admin', resource_path('/views/admin/'));

        // 设置diff输出的语言类型
        Carbon::setLocale(config('app.carbon_locale'));
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

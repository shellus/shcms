<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\ArticleRepository::class, \App\Repositories\ArticleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\ArticleRepository::class, \App\Repositories\ArticleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\ArticleRepository::class, \App\Repositories\ArticleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\CommentRepository::class, \App\Repositories\CommentRepositoryEloquent::class);
        //:end-bindings:
    }
}

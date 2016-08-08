<?php

namespace App\Providers;

use App\SiteConfig;
use Illuminate\Support\ServiceProvider;
use Cache;
use KodiComponents\Navigation\Navigation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Blade::directive('title', function($expression) {
            return "<?php \$title={$expression}; ?>";
        });

        $navigation = new Navigation([
            [
                'title' => 'Test',
                'icon' => 'fa fa-user',
                'priority' => 500,
                'url' => 'http://site.com',
                'pages' => [
                    [
                        'title' => 'Test3',
                        'icon' => 'fa fa-user',
                        'url' => 'http://site.com',
                    ],
                ],
            ],
            [
                'title' => 'Test1',
                'icon' => 'fa fa-user',
                'priority' => 600,
                'url' => 'http://site.com',
            ],
        ]);
        $this->app->instance('shcms.navigation', $navigation);

//        echo $navigation->render();
//        dd();

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

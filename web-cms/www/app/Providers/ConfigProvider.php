<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ConfigProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            ['*'],
            'App\Http\ViewComposers\AdminComposer'
        );
        View::composer(
            ['Store/*'],
            'App\Http\ViewComposers\StoreComposer'
        );
    }
}

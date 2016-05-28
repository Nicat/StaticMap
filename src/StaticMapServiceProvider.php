<?php

namespace Nicat\StaticMap;

use Illuminate\Support\ServiceProvider;

class StaticMapServiceProvider extends ServiceProvider {

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/static-map.php' => config_path('static-map.php'),
        ], 'config');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/static-map.php', 'static-map');

        $this->app->bind('static-map', 'Nicat\StaticMap\StaticMap');
    }
}
<?php

namespace GMJ\LaravelBlock2Map;

use GMJ\LaravelBlock2Map\View\Components\Frontend;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LaravelBlock2MapServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadRoutesFrom(__DIR__ . "/routes/web.php", 'LaravelBlock2Map');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'LaravelBlock2Map');
        $this->loadViewsFrom(__DIR__ . '/resources/views/config', 'LaravelBlock2MapConfig');

        Blade::component("LaravelBlock2Map", Frontend::class);

        $this->publishes([
            __DIR__ . '/config/laravel_block2_map_config.php' => config_path('gmj/laravel_block2_map_config.php'),
            __DIR__ . '/database/seeders' => database_path('seeders'),
        ], 'GMJ\LaravelBlock2Map');
    }


    public function register()
    {
    }
}

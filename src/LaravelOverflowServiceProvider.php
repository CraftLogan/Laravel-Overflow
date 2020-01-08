<?php

namespace CraftLogan\LaravelOverflow;

use Illuminate\Support\ServiceProvider;

class LaravelOverflowServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-overflow');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-overflow');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

//        if ($this->app->runningInConsole()) {
//            $this->publishes([
//                __DIR__.'/../config/config.php' => config_path('laravel-overflow.php'),
//            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-overflow'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laravel-overflow'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-overflow'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        //}
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
//        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-overflow');

//        // Register the main class to use with the facade
//        $this->app->singleton('laravel-overflow', function () {
//            return new LaravelOverflow;
//        });
    }
}

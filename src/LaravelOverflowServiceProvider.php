<?php

namespace CraftLogan\LaravelOverflow;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class LaravelOverflowServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        Request::macro('overflow', function (Model $model, $properties = "properties") {
            $overflow = new LaravelOverflow($this, $model, $properties);
            return $overflow->overflow();
        });

        Request::macro('allWithOverflow', function (Model $model, $properties = "properties") {
            $overflow = new LaravelOverflow($this, $model, $properties);
            return $overflow->allWithOverflow();
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }
}

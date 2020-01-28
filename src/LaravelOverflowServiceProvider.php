<?php

namespace CraftLogan\LaravelOverflow;

use CraftLogan\LaravelOverflow\Requests\OverflowFormRequest;
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
            $overflow = new OverflowFormRequest($model, $properties);
            return $overflow->overflow();
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

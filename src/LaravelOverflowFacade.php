<?php

namespace CraftLogan\LaravelOverflow;

use Illuminate\Support\Facades\Facade;

/**
 * @see \CraftLogan\LaravelOverflow\Skeleton\SkeletonClass
 */
class LaravelOverflowFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-overflow';
    }
}

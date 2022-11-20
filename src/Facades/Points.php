<?php

namespace OutMart\Laravel\RewardPoints\Facades;

use Illuminate\Support\Facades\Facade;

class Points extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'points';
    }
}
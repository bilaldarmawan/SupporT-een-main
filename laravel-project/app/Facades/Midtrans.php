<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Midtrans extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'midtrans';
    }
}

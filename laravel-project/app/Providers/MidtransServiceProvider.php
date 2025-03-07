<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Midtrans\Config;

class MidtransServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('midtrans', function () {
            Config::$serverKey = config('services.midtrans.serverKey');
            Config::$clientKey = config('services.midtrans.clientKey');
            Config::$isProduction = config('services.midtrans.isProduction');
            Config::$isSanitized = config('services.midtrans.isSanitized');
            Config::$is3ds = config('services.midtrans.is3ds');
        
            return new \Midtrans\Snap();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
       //
}
}
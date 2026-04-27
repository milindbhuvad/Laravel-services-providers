<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PayuService;

class PayuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(PayuService::class, function ($app) {
            return new PayuService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

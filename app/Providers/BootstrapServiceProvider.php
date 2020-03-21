<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BootstrapServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Services\TestServiceInterface::class, \App\Services\TestService::class);
        $this->app->bind(\App\Services\UserServiceInterface::class, \App\Services\UserService::class);
        $this->app->bind(\App\Services\RequestSupplierServiceInterface::class, \App\Services\RequestSupplierService::class);
        //:end-bindings:
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(\App\Repositories\Repositories\UserRepositoryRepositoryInterface::class, \App\Repositories\Repositories\UserRepositoryRepository::class);
        $this->app->bind(\App\Repositories\UserRepositoryRepositoryInterface::class, \App\Repositories\UserRepositoryRepository::class);
        $this->app->bind(\App\Repositories\RequestSupplierRepositoryInterface::class, \App\Repositories\RequestSupplierRepository::class);
        $this->app->bind(\App\Repositories\TestRepositoryInterface::class, \App\Repositories\TestRepository::class);
        $this->app->bind(\App\Repositories\TestRepositoryInterface::class, \App\Repositories\TestRepository::class);
        //:end-bindings:
    }
}

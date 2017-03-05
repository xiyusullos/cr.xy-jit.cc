<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\Contracts\ClassroomRepository::class, \App\Repositories\Eloquent\ClassroomRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\ReservationRepository::class, \App\Repositories\Eloquent\ReservationRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\ProfileRepository::class, \App\Repositories\Eloquent\ProfileRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\UserRepository::class, \App\Repositories\Eloquent\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\AuthenticateRepository::class, \App\Repositories\Eloquent\AuthenticateRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\CodeRepository::class, \App\Repositories\Eloquent\CodeRepositoryEloquent::class);
        //:end-bindings:
    }
}

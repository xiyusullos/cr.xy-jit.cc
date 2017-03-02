<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $productionServiceProviders = [
            // For production
            \Encore\Admin\Providers\AdminServiceProvider::class,
            \Prettus\Repository\Providers\RepositoryServiceProvider::class,
            \App\Providers\RepositoryServiceProvider::class,
            \Tymon\JWTAuth\Providers\JWTAuthServiceProvider::class,
        ];
        foreach ($productionServiceProviders as $serviceProvider) {
            $this->app->register($serviceProvider);
        }

        $developmentServiceProviders = [
            // For development
            \Barryvdh\Debugbar\ServiceProvider::class,
            \Sven\ArtisanView\ArtisanViewServiceProvider::class,
            \Xethron\MigrationsGenerator\MigrationsGeneratorServiceProvider::class,
            \Orangehill\Iseed\IseedServiceProvider::class,
            \Iber\Generator\ModelGeneratorProvider::class,
            \Mpociot\LaravelTestFactoryHelper\TestFactoryHelperServiceProvider::class,
        ];

        if ($this->app->environment() == 'local') {
            foreach ($developmentServiceProviders as $serviceProvider) {
                $this->app->register($serviceProvider);
            }
        }
    }
}

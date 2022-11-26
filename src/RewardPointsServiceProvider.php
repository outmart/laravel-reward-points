<?php

namespace OutMart\Laravel\RewardPoints;

use Illuminate\Support\ServiceProvider;

class RewardPointsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->app->singleton('points', function () {
            return new PointsManager();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../database/migrations/' => database_path('migrations/outmart'),
            ], ['outmart-migrations', 'outmart-migrations-reward-points']);
        }
    }
}

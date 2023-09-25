<?php

namespace App\Providers;

use App\Service\FakeService;
use Illuminate\Support\ServiceProvider;

class FakeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            FakeService::class,
            function ($app) {
                $config = 'ddd';
                return new FakeService($config);
            }
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

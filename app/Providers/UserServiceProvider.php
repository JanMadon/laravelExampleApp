<?php

namespace App\Providers;

use App\Repository\Eloquent\UserRepository as EloquentUserRepository;
use App\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserRepository::class,
            EloquentUserRepository::class
        );

        // $this->app->singleton(
        //     UserRepository::class,
        //     function($app) {
        //         return new EloquentUserRepository(
        //             $app->make(User::class)
        //         );

        //     }
        // );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

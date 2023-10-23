<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class  // tutaj rejstruje się polityke
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        
        Gate::define('admin-level', function (User $user) {
           // return false;
            //if($user->isAdmin()) {
            //if(false) {
            //     return Response::allow();
            // } else {
            //     return Response::deny('Muszisz mieć uprawnienia admistratora');
            // }
            
            return $user->isAdmin();
            //return false;
        });
    }
}

<?php

namespace App\Providers;
use App\User;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
      */
   
   
     //Süper Admin kullanımı
     public function boot()
     {
         $this->registerPolicies();
 
         // Implicitly grant "Super Admin" role all permissions
         // This works in the app by using gate-related functions like auth()->user->can() and @can()
         Gate::before(function ($user, $ability) {
             return $user->hasRole('Super Admin') ? true : null;
         });
     }
}

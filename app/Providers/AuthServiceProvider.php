<?php

namespace App\Providers;

use App\Models\Internship;
use App\Models\User;
use App\Policies\InternshipPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */


    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Internship::class => InternshipPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        // Gate::define('show-intern',function(User $user ,Internship $internship){
        //     return true;
        // });
    }
}

<?php

namespace App\Providers;

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
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::resource('accounts', 'App\Policies\AccountPolicy');
        Gate::define('accounts.staff', 'App\Policies\AccountPolicy@staff');
        Gate::resource('recruitments', 'App\Policies\RecruitmentPolicy');
        Gate::resource('companies', 'App\Policies\CompanyPolicy');
        Gate::resource('faculties', 'App\Policies\FacultyPolicy');

        //
    }
}

<?php

namespace App\Providers;

use App\Enum\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('admin', function (User $user) {
            return $user->role == Role::ADMIN->value;
        });

        Gate::define('manager', function (User $user) {
            return $user->role == Role::MANAGER->value;
        });

        Gate::define('user', function (User $user) {
            return $user->role == Role::USER->value;
        });
    }
}

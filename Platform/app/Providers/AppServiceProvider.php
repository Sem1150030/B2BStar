<?php

namespace App\Providers;

use App\RoleTypes;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('access-backoffice', function ($user) {
            if ($user->role_type != null){
                return in_array($user->role_type, ['App\Models\Admin', RoleTypes::BRAND->value]);
            }
        });
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use App\User;

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
        // Provider hasRole
        Blade::if('hasRole', function ($expression) {

            if (Auth::user()) {
                if (Auth::user()->hasAnyRole($expression)) {
                    return true;
                }
            }
            return false;
        });
    }
}

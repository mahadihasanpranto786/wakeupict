<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
        // Ensure student auth guard is always registered even if server has stale config cache
        if (!config('auth.guards.student')) {
            config([
                'auth.guards.student' => [
                    'driver'   => 'session',
                    'provider' => 'students',
                ],
                'auth.providers.students' => [
                    'driver' => 'eloquent',
                    'model'  => \App\model\StudentAccount::class,
                ],
            ]);
        }
    }
}

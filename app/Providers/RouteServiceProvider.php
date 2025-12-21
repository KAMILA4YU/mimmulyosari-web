<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/user/dashboard';

    public function boot(): void
    {
        $this->routes(function () {

            // Route utama (web publik)
            Route::middleware('web')
                ->group(base_path('routes/web.php'));


            // Route API
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
        });
    }
}

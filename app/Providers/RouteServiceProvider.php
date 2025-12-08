<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/admin/tableaudebord';

    public function boot(): void
    {
        $this->routes(function () {
            // ✅ 1. D'ABORD les routes d'authentification Laravel
            Route::middleware('web')
                ->group(base_path('routes/auth.php'));

            // ✅ 2. ENSUITE les routes Front (PUBLIQUES)
            Route::middleware('web')
                ->group(base_path('routes/front.php'));

            // ✅ 3. ENSUITE les routes Admin (PROTÉGÉES)
            Route::middleware(['web', 'auth'])
                ->prefix('admin')
                ->as('admin.')
                ->group(base_path('routes/admin.php'));

            // ✅ 4. ENFIN les routes web générales (si vous en avez)
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}

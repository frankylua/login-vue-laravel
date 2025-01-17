<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route; // Asegúrate de que esta línea esté presente
use Illuminate\Routing\Router;

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
        

    // Esto asegura que las rutas del archivo api.php estén siendo cargadas
    Route::prefix('api')
         ->middleware('api')
         ->group(base_path('routes/api.php'));
    }
}

<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HandleCors
{
    /**
     * Maneja una solicitud de CORS.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->getMethod() == "OPTIONS") {
            return response('', 200)
                    ->header('Access-Control-Allow-Origin', '*')
                    ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                    ->header('Access-Control-Allow-Headers', 'Content-Type, X-Requested-With, Authorization');
        }
        // Permitir CORS para todos los dominios
        return $next($request)
                ->header('Access-Control-Allow-Origin', '*')  // Permite todos los orígenes
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')  // Métodos permitidos
                ->header('Access-Control-Allow-Headers', 'Content-Type, X-Requested-With, Authorization');  // Encabezados permitidos
    }
}

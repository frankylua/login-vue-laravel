<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CorsMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Definir los orígenes permitidos
        $allowedOrigins = ['http://localhost:8080']; 

        // Verificar si el origen de la solicitud está permitido
        $origin = $request->headers->get('Origin');
        if (in_array($origin, $allowedOrigins)) {
            // Agregar cabeceras CORS
            return $next($request)
                ->header('Access-Control-Allow-Origin', $origin)
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->header('Access-Control-Allow-Headers', 'Content-Type, X-Requested-With, Authorization');
        }

        // Continuar con la solicitud sin CORS si el origen no está permitido
        return $next($request);
    }
}


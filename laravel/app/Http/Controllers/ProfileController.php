<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Mostrar la información del perfil del usuario autenticado.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
        
        // Retornar los datos del perfil en formato JSON
        return response()->json($user);
    }
}

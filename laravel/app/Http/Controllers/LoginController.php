<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validación de los datos de inicio de sesión
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json([
                'message' => 'Inicio de sesión exitoso',
                'user' => $user,
                'token' => $user->createToken('authToken')->plainTextToken,
            ]);

            
        }

        // Si la autenticación falla
        return response()->json(['message' => 'Credenciales incorrectas'], 401);
    }
}

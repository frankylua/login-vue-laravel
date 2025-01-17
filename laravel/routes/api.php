<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;

// Rutas públicas
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

// Ruta protegida, requiere autenticación
Route::middleware('auth:sanctum')->get('/profile', [ProfileController::class, 'show']);
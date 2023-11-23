<?php

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
    /**
     * Rutas de Invitados
     */
    // Iniciar Sesión
    Route::post('login', [AuthController::class, 'login']);
    //Crear usuario
    Route::post('/admin/users', [UserController::class, 'store']);
    //Visualizar usuarios
    Route::get('/admin/users', [UserController::class, 'index']);
    //Eliminar usuario
    Route::delete('/admin/users{id}',[UserController::class, 'destroy']);

    Route::middleware('jwt.verify')->group(function(){






        // Route::delete('/admin/users{rut_dni}', [UserController::class, 'delete']);
    });

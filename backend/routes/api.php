<?php

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

/**
 * Rutas de Admins
 */
Route::middleware(['jwt'])->group(function () {
    // Logout
    Route::post('/admin/users/logout', [AuthController::class, 'logout']);
    // Visualizar usuarios
    Route::get('/admin/users', [UserController::class, 'index']);
    // Crear usuario
    Route::post('/admin/users', [UserController::class, 'store']);
    // Editar usuario
    Route::put('/admin/users/{rut_dni}', [UserController::class, 'edit']);
    // Eliminar usuario
    Route::delete('/admin/users/{rut_dni}', [UserController::class, 'destroy']);
    // Buscar usuario por rut
    Route::get('/admin/users/rut/{rut_dni}', [UserController::class, 'findRut']);
    // Buscar usuario por email
    Route::get('/admin/users/email/{email}', [UserController::class, 'findEmail']);
});

<?php

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\auth\AuthController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


    /**
     * Rutas de Invitados
     */
        //1. Iniciar Sesión
        Route::post('login', [AuthController::class, 'login']);

    /**
     * Rutas Autenticados
     */
    Route::middleware('jwt.verify')->group(function(){
        Route::post('logout',[AuthController::class, 'logout']);
    });

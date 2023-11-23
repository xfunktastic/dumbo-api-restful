<?php

namespace App\Http\Controllers\auth;

use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('username', 'password');

        try {
            // Autenticar el usuario
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'error' => 'Credenciales inválidas',
                ], 400);
            }
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'No se pudo crear el token',
            ], 500);
        }

        // Verifica si es un admin
        $user = JWTAuth::user();
        if ($user->role !== 'admin') {
            // Cerrar sesión y eliminar el token si el usuario no es un admin
            JWTAuth::invalidate(JWTAuth::getToken());

            return response([
                'error' => 'No tienes permisos para acceder',
            ], 403);
        }

        $rut = $user->rut_dni;

        return response()->json([
            'success' => 'Inicio de sesión exitoso',
            'token' => $token,
            'rut' => $rut,
        ], 200);
    }

    public function logout()
    {
        try {
            // Invalidar el token actual del usuario
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'success' => 'Cierre de sesión exitoso',
            ], 200);
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'No se pudo cerrar sesión',
            ], 500);
        }
    }
}

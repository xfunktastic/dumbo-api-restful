<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Redirect;
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
    }
}

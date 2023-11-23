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
    public function login(LoginRequest $request){
        $credentials = $request->only('username', 'password');
        $role = User::where('username',$request->username)->first()->role;
        $rut = User::where('username',$request->username)->first()->rut_dni;
        try {
            // Autenticar el usuario
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'error' => 'Credenciales inválidas',
                ], 400);
            }
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'No se creó el token',
            ], 500);
        }
            // Verifica si es un admin
        if ($role!='admin'){
            return response([
                'error'=>'No tienes permisos para acceder'
            ],403);
        }
        return response()->json([
            'success'=>'Inicio de sesión exitoso',
            'token'=>$token,
            'rut'=>$rut,
        ],200);
    }

    public function logout()
    {
    }
}

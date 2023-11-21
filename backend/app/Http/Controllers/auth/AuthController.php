<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(LoginRequest $request){
        $credentials = $request->only('username', 'password');
        $role = User::where('username',$request->username)->first()->role;
        $rut = User::where('username',$request->username)->first()->rut_dni;
        try {
            // Intentar autenticar al usuario con las credenciales recibidas.
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Credenciales inválidas',
                ], 400);
            }
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'No se creó el token',
            ], 500);
        }
        if ($role!='admin'){
            return response([
                'error'=>'No tienes permisos para acceder'
            ]);
        }
        return response()->json([
            'accesed'=>'Inicio de sesión exitoso',
            'token'=>$token,
            'rut'=>$rut,
        ],200);
    }

    public function logout(Request $request)
    {
        try {
            // Obtener el token del usuario autenticado
            $token = JWTAuth::parseToken();

            // Invalidar el token para cerrar sesión
            $token->invalidate();

            // Eliminar el token del cliente
            JWTAuth::parseToken()->invalidate(true);

            // Redirigir a la pantalla de inicio de sesión
            return redirect()->route('login')->with('success', 'Sesión cerrada correctamente');
        } catch (\Exception $e) {
            // Manejar cualquier error que pueda ocurrir durante el cierre de sesión
            return response()->json(['error' => 'Error al cerrar sesión'], 500);
        }
    }

    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

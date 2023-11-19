<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {

        //Creamos el usuario
        $user = User::create([
            'rut_dni' => $request->rut_dni,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'points' => $request->points,
            'role' => 'user'
        ]);

        //Generamos token
        $token = JWTAuth::fromUser($user);

        return response()->json([
            'user'=> $user,
            'token' => $token,
        ]);
    }

    public function login(LoginRequest $request)
    {


    }


    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}

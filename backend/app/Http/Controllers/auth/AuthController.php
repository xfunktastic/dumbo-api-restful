<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

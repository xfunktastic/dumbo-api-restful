<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //1. Crear Usuario
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'rut_dni' => [
                    'unique:users',
                    'required',
                    'string',
                    'max:25',
                    'regex:/^[0-9]{8}-[0-9kK]{1}$/',
                ],
                'name' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    'unique:users',
                ],
                'points' => 'required|integer|min:0',
                'role' => 'in:user',
            ], [
                'rut_dni.unique' => 'El RUT ya está en uso.',
                'rut_dni.required' => 'El campo RUT es obligatorio.',
                'rut_dni.string' => 'El RUT debe ser una cadena de texto.',
                'rut_dni.max' => 'El RUT no debe superar los :max caracteres.',
                'rut_dni.regex' => 'El formato del RUT no es válido.',
                'name.required' => 'El campo nombre es obligatorio.',
                'name.string' => 'El nombre debe ser una cadena de texto.',
                'name.max' => 'El nombre no debe superar los :max caracteres.',
                'lastname.required' => 'El campo apellido es obligatorio.',
                'lastname.string' => 'El apellido debe ser una cadena de texto.',
                'lastname.max' => 'El apellido no debe superar los :max caracteres.',
                'email.required' => 'El correo electrónico es obligatorio.',
                'email.string' => 'El correo electrónico debe ser una cadena de texto.',
                'email.email' => 'El correo electrónico no tiene un formato válido.',
                'email.max' => 'El correo electrónico no debe superar los :max caracteres.',
                'email.unique' => 'El correo electrónico ya está en uso.',
                'points.required' => 'El campo puntos es obligatorio.',
                'points.integer' => 'Los puntos deben ser un valor entero.',
                'points.min' => 'Los puntos no pueden ser menores que :min.',
                'role.in' => 'El valor del campo rol no es válido. Debe ser un usuario.',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            $user = User::create([
                'rut_dni' => $request->input('rut_dni'),
                'name' => $request->input('name'),
                'lastname' => $request->input('lastname'),
                'email' => $request->input('email'),
                'points' => $request->input('points'),
                'role' => $request->input('role', 'user'),
            ]);

            return response()->json(['success' => 'Se ha creado un usuario', 'user' => $user], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el usuario: ' . $e->getMessage()], 500);
        }
    }
    // 2. Visualizar Usuarios
    public function index()
    {
        try {
            $users = User::where('rut_dni', '!=', 'admin')->select('rut_dni', 'name', 'lastname', 'email', 'points')->get();

            if ($users->isEmpty()) {
                return response()->json(['message' => 'No hay usuarios disponibles'], 200);
            }
            return response()->json([
                'users' => $users,
                'success'=> 'Se han obtenido todos los usuarios'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los usuarios'], 500);
        }
    }

    // 3. Eliminar un usuario
    public function destroy($rut_dni){
        try {
            $rut_dni = str_replace(['-', ' '], '', $rut_dni);
        $user = User::find($rut_dni);

            if (!$user) {
                return response()->json(['error' => 'Usuario no encontrado'], 404);
            }

            $user->delete();

            return response()->json(['success' => 'Usuario eliminado correctamente'], 200);
        } catch (\Exception $e) {
            Log::info('SQL de la consulta: ' . User::find($rut_dni)->toSql());
            return response()->json(['error' => 'Error al eliminar este usuario'], 500);
        }
    }
}



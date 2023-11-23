<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //Visualizar Usuarios
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
    //Crear usuario
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

            $userData = [
                'name' => $user->name,
                'lastname' => $user->lastname,
                'email' => $user->email,
                'rut_dni' => $user->rut_dni,
                'points' => $user->points,
            ];

            return response()->json(['success' => 'Se ha creado un usuario', 'user' => $userData], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el usuario: ' . $e->getMessage()], 500);
        }
    }
    //Editar usuario
    public function edit(Request $request, $rut_dni)
    {
        try {
            $user = User::where('rut_dni', $rut_dni)->first();

            if (!$user) {
                return response()->json(['error' => 'Usuario no encontrado'], 404);
            }

            // Check if all input fields are the same as existing user data
            if (
                $request->input('name') === $user->name &&
                $request->input('lastname') === $user->lastname &&
                $request->input('email') === $user->email &&
                $request->input('points') === $user->points
            ) {
                return response()->json(['message' => 'No has hecho cambios'], 200);
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($user->id), // Ignore the current user's email
                ],
                'points' => 'required|integer|min:0',
            ], [
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
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            // Update user data
            $user->name = $request->input('name', $user->name);
            $user->lastname = $request->input('lastname', $user->lastname);
            $user->email = $request->input('email', $user->email);
            $user->points = $request->input('points', $user->points);
            $user->save();

            $userData = [
                'name' => $user->name,
                'lastname' => $user->lastname,
                'email' => $user->email,
                'rut_dni' => $user->rut_dni,
                'points' => $user->points,
            ];

            return response()->json(['success' => 'Usuario actualizado correctamente', 'user' => $userData], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el usuario: ' . $e->getMessage()], 500);
        }
    }


    //Eliminar usuario
    public function destroy($rut_dni)
    {
        try {
            if ($rut_dni === 'admin') {
                return response()->json(['error' => 'No se puede eliminar al usuario admin'], 400);
            }
            $user = User::where('rut_dni', $rut_dni)->first();

            if ($user) {
                $user->delete();
                return response()->json(['success' => 'Usuario eliminado correctamente'], 200);
            } else {
                return response()->json(['error' => 'Usuario no encontrado'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el usuario: ' . $e->getMessage()], 500);
        }
    }

    //Buscar usuario rut
    public function findRut($rut_dni)
    {
        try {
            // Check if $rut_dni is "admin" and return an error if true
            if ($rut_dni === 'admin') {
                return response()->json(['error' => 'No se puede buscar al usuario admin'], 400);
            }

            $user = User::where('rut_dni', $rut_dni)->select('rut_dni', 'name', 'lastname', 'email', 'points')->firstOrFail();

            return response()->json(['user' => $user, 'success' => 'Usuario encontrado'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener el usuario'], 500);
        }
    }

    //Buscar usuario email
    public function findEmail($email)
    {
        try {
            // Check if $email is associated with the admin user and return an error if true
            if ($email === 'admin@example.com') {
                return response()->json(['error' => 'No se puede buscar al usuario admin'], 400);
            }

            $user = User::where('email', $email)->select('rut_dni', 'name', 'lastname', 'email', 'points')->firstOrFail();

            return response()->json(['user' => $user, 'success' => 'Usuario encontrado'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener el usuario'], 500);
        }
    }

}



<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'rut_dni' => ['required', 'regex:/^[0-9]{8,9}-[0-9kK]{1}$/i'],
            'name' => ['required','min:5'],
            'lastname' => ['required','min:5'],
            'email' => ['required','email'],
            'points' => ['required','numeric'],
        ];
    }

    public function messages(){
        return [
            'rut_dni.required' => 'Ingresar el campo rut/dni es obligatorio',
            'name.required' => 'Ingresar el campo nombres es obligatorio',
            'lastname.required' => 'Ingresar el campo apellidos es obligatorio',
            'email.required' => 'Ingresar el campo email es obligatorio',
            'email.email' => 'El formato del correo electrónico no es correcto',
            'points.required' => 'Ingresar el campo puntos es obligatorio',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors'=>$validator->errors(),
        ], 422));
    }
}

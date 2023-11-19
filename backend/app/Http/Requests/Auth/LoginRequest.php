<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
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
        {
            return [
                'username' => ['required','min:5'],
                'password' => ['required','min:5'],
            ];
        }
    }

    public function messages(){
        return [
            'username.required' => 'Ingresar el campo Usuario es obligatorio',
            'password.required' => 'Ingresar el campo Contraseña es obligatorio',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors'=>$validator->errors(),
        ], 422));
    }
}

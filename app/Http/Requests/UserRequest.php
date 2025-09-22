<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'=> 'required',
            'email'=>'required',
            'password'=>'required|max:30|min:7',
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'Campo Requerido',
            'email.required' => 'Campo Requerido',
            'password.required' => 'Por favor ingrese una contraseña',
            'password.max' => 'La contraseña excede el limite de caracteres',
            'password.min' => 'La contraseña debe tener mas de 7 caracteres'
        ];
    }
}

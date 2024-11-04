<?php

namespace App\Http\Requests\Auth;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

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
            'username' => [
            'required',
            'string',
            'min:3',
            'max:20',
            'unique:users,username',
            'alpha_dash',
            ],

            'email' => [
            'required',
            'string',
            'email',
            'max:255',
            'unique:users,email',
            ],

            'password' => [
            'required',
            'string',
            'min:8',
            'max:255',
            'confirmed',
            Password::defaults(),
            ]
            
        ];
    }


}

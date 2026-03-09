<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'email' => 'required|string|email|exists:users,email|max:255',
            'password' => 'required|string|min:8',
        ];
    }
    public function messages()
    {
        return   [
            'email.required' => 'L\'email est requis',
            'password.required' => 'Le mot de passe est requis',
            'email.exists' => 'L\'email n\'existe pas',
            'password.min' => 'Le mot de passe doit avoir au moins 8 caractères',
            'email.email' => 'L\'email n\'est pas valide',
        ];
    }
}

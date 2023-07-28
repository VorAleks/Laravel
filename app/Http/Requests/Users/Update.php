<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Update extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'string', 'max:250', 'unique:users,email'],
            'currentPassword' => ['nullable|required'],
            'password' => ['nullable'],
            'password-confirm' => ['nullable'],
            'isAdmin' => ['boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'newPassword' => 'Новый пароль'
        ];
    }
}

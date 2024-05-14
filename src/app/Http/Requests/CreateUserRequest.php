<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => ['required', 'min:3', 'max:20', Rule::unique('users')],
            'name' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->route('user')?->id)],
            'auth_id' => ['required', Rule::unique('users')],
        ];
    }
}

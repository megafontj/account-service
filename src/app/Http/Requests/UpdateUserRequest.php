<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        $user = $this->route('user');

        return [
            'username' => ['sometimes', 'min:3', 'max:20', Rule::unique('users')->ignore($user?->id)],
            'name' =>   ['sometimes', 'string'],
            'email' => ['sometimes', 'email', Rule::unique('users')->ignore($user?->id)],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FollowAndUnfollowRequest extends FormRequest
{
    public function rules()
    {
        return [
            'user_id' => ['required', 'integer', Rule::exists('users', 'id')]
        ];
    }

    public function getUserId(): int
    {
        return $this->validated()['user_id'];
    }

}

<?php

namespace App\Support\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'filter' => 'array',
            'include' => 'array',
            'sort' => 'array',
        ];
    }
}

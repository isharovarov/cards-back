<?php

namespace App\Http\Api\V1\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'image_id' => 'int|exists:images,id',
            'email' => 'required|email|exists:users,email',
            'name' => 'string',
            'password' => 'required|string|min:6',
        ];
    }
}

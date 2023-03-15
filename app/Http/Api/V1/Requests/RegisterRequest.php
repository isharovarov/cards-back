<?php

namespace App\Http\Api\V1\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string',
            'email' => 'required|email:rfc',
            'password' => 'required|string',
        ];
    }
}

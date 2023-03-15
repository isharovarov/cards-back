<?php

namespace App\Http\Api\V1\Controllers;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    private const GUARD_NAME = 'sanctum';

    protected function guard(): Guard
    {
        return auth()->guard(self::GUARD_NAME);
    }

    protected function getAuthUser(): User
    {
        if ($this->guard()->guest()) {
            throw new AuthenticationException();
        }

        return $this->guard()->user();
    }
}

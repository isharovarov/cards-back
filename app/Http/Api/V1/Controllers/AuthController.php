<?php

namespace App\Http\Api\V1\Controllers;

use App\Http\Api\V1\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class AuthController extends Controller
{
    public function login(LoginRequest $request): Response
    {
        $user = User::firstWhere('email', $request->input('email'));

        if ($user !== null && Hash::check($request->input('password'), $user->password)) {
            return response()->json(['token' => $user->createToken('auth_token')->plainTextToken]);
        }

        throw new ConflictHttpException('These credentials do not match our records.');
    }

    public function logout(): Response
    {
        $this->getAuthUser()->tokens()->delete();

        return response()->json(null)->setStatusCode(Response::HTTP_NO_CONTENT);
    }
}

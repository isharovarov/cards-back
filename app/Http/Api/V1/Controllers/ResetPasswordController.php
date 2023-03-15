<?php

namespace App\Http\Api\V1\Controllers;

use App\Http\Api\V1\Requests\ResetPasswordRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class ResetPasswordController extends Controller
{
    public function __construct(
        private readonly UserService $service
    )
    {
    }

    public function sendResetLink(Request $request): Response
    {
        $request->validate([
            'email' => 'required|exists:users,email'
        ]);

        $user = $this->service->findByEmail($request->input('email'));

        if ($user === null || !$user->hasVerifiedEmail()) {
            throw new ConflictHttpException('These credentials do not match our records.');
        }

        Password::sendResetLink($request->only('email'));

        return response()->setStatusCode(Response::HTTP_OK);
    }

    public function resetPassword(ResetPasswordRequest $request): Response
    {
        $user = $this->service->findByEmail($request->input('email'));

        $status = Password::reset(
            $request->validated(),
            function ($user, $password) {
                $user->password = $password;
                $user->save();
            }
        );

        if ($status === Password::INVALID_TOKEN) {
            throw new BadRequestException('Invalid reset token');
        }

        return $this->response(['token' => $user->createToken('auth_token')->plainTextToken]);
    }
}

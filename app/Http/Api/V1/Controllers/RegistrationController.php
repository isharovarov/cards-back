<?php

namespace App\Http\Api\V1\Controllers;

use App\Http\Api\V1\Requests\RegisterRequest;
use App\Services\Dto\UserRegistrationDto;
use App\Services\UserService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class RegistrationController extends Controller
{
    public function __construct(
        private readonly UserService $service
    )
    {
    }

    public function registration(RegisterRequest $request): Response
    {
        if ($this->service->isExistUser($request->input('email'))) {
            throw new ConflictHttpException('User already registered');
        }

        $this->service->register($this->prepareUserRegistrationDto($request));

        return response()->json(null)->setStatusCode(Response::HTTP_OK);
    }

    private function prepareUserRegistrationDto(RegisterRequest $request): UserRegistrationDto
    {
        return new UserRegistrationDto(
            name: $request->input('name'),
            email: $request->input('email'),
            password: $request->input('password'),
        );
    }
}

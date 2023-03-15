<?php

namespace App\Http\Api\V1\Controllers;

use App\Http\Api\V1\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\Dto\UserUpdateDto;
use App\Services\UserService;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $service
    )
    {
    }

    public function show(): UserResource
    {
        return new UserResource($this->getAuthUser()->load('image'));
    }

    public function update(UpdateUserRequest $request): Response
    {
        $this->service->update(
            user: $this->getAuthUser(),
            dto: new UserUpdateDto(
                imageId: $request->input('image_id'),
                name: $request->input('name'),
                email: $request->input('email'),
                password: $request->input('password'),
            )
        );

        return response()->setStatusCode(Response::HTTP_OK);
    }
}

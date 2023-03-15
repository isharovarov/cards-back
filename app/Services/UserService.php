<?php

namespace App\Services;

use App\Models\User;
use App\Services\Dto\UserRegistrationDto;
use App\Services\Dto\UserUpdateDto;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function find(int $id): ?User
    {
        return User::where('id', $id)->with('image')->first();
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function register(UserRegistrationDto $dto): void
    {
        User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
        ]);
    }

    public function isExistUser(string $email): bool
    {
        return User::query()
            ->where('email', $email)
            ->exists();
    }

    public function update(User $user, UserUpdateDto $dto): User
    {
        $user->update([
            'image_id' => $dto->imageId,
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => $dto->password,
        ]);

        return $user->fresh();
    }
}

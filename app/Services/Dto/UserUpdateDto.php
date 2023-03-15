<?php

namespace App\Services\Dto;

class UserUpdateDto
{
    public function __construct(
        public ?int    $imageId,
        public ?string $name,
        public ?string $email,
        public ?string $password,
    ) {
    }
}

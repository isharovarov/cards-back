<?php

namespace App\Services\Dto;

class UserRegistrationDto
{
    public function __construct(
        public ?string $name,
        public string  $email,
        public string  $password,
    ) {
    }
}

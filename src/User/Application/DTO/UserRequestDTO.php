<?php

namespace App\User\Application\DTO;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class UserRequestDTO
{
    public function __construct(
        #[NotBlank]
        #[Length(min: 7, max: 20)]
        #[Regex(pattern: '/^[a-zA-Z0-9-_]{2,}$/')]
        public string $name,
        #[NotBlank]
        #[Email]
        public string $email,
        #[NotBlank]
        #[Length(exactly: 12)]
        public string $phone,
        #[NotBlank]
        #[Length(min: 7, max: 25)]
        public string $password,
    ) {
    }
}

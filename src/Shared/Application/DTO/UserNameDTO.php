<?php

namespace App\Shared\Application\DTO;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class UserNameDTO
{
    #[NotBlank]
    #[Length(min: 7, max: 20)]
    #[Regex(pattern: '/^[a-zA-Z0-9-_]{2,}$/')]
    public string $username;

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
}

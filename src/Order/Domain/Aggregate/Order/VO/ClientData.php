<?php

namespace App\Order\Domain\Aggregate\Order\VO;

use JetBrains\PhpStorm\Immutable;

#[Immutable]
class ClientData
{
    public function __construct(
        private readonly string $name,
        private readonly string $phoneNumber,
        private readonly string $email)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}

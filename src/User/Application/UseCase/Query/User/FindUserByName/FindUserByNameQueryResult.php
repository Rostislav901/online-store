<?php

namespace App\User\Application\UseCase\Query\User\FindUserByName;

use App\User\Application\DTO\UserResponseDTO;

class FindUserByNameQueryResult
{
    public function __construct(
        public readonly UserResponseDTO $DTO,
        private readonly string $user_uld)
    {
    }

    public function getUserUld(): string
    {
        return $this->user_uld;
    }
}

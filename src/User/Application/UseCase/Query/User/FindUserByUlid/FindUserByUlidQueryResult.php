<?php

namespace App\User\Application\UseCase\Query\User\FindUserByUlid;

use App\User\Application\DTO\UserResponseDTO;

class FindUserByUlidQueryResult
{
    public function __construct(public UserResponseDTO $userResponseDTO)
    {
    }
}

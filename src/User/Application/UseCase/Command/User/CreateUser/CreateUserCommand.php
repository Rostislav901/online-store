<?php

namespace App\User\Application\UseCase\Command\User\CreateUser;

use App\Shared\Application\Command\CommandInterface;
use App\User\Application\DTO\UserRequestDTO;

class CreateUserCommand implements CommandInterface
{
    public function __construct(private readonly UserRequestDTO $requestDTO)
    {
    }

    public function getRequestDTO(): UserRequestDTO
    {
        return $this->requestDTO;
    }
}

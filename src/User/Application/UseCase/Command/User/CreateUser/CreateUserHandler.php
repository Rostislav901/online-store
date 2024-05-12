<?php

namespace App\User\Application\UseCase\Command\User\CreateUser;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\User\Domain\Service\UserMaker;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationSuccessResponse;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;

class CreateUserHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly AuthenticationSuccessHandler $successHandler,
        private readonly UserMaker $userMaker)
    {
    }

    public function __invoke(CreateUserCommand $command): JWTAuthenticationSuccessResponse
    {
        $commandData = $command->getRequestDTO();
        $user = $this->userMaker->makeUser(
            name: $commandData->name,
            phone: $commandData->phone,
            email: $commandData->email,
            password: $commandData->password
        );

        return $this->successHandler->handleAuthenticationSuccess($user);
    }
}

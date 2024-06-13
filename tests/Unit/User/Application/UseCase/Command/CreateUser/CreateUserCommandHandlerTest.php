<?php

namespace App\Tests\Unit\User\Application\UseCase\Command\CreateUser;

use App\User\Application\DTO\UserRequestDTO;
use App\User\Application\UseCase\Command\User\CreateUser\CreateUserCommand;
use App\User\Application\UseCase\Command\User\CreateUser\CreateUserHandler;
use App\User\Domain\Aggregate\User\Entity\User;
use App\User\Domain\Service\UserMaker;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationSuccessResponse;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;
use PHPUnit\Framework\TestCase;

class CreateUserCommandHandlerTest extends TestCase
{
    public function testInvoke(): void
    {
        $userMaker = $this->createMock(UserMaker::class);
        $successHandler = $this->createMock(AuthenticationSuccessHandler::class);
        $user = $this->createMock(User::class);
        $userMaker->expects($this->once())
                    ->method('makeUser')
                    ->with('test-name', 'test-phone', 'test-email', 'test-password')
                    ->willReturn($user);

        $successHandler->expects($this->once())
                    ->method('handleAuthenticationSuccess')
                    ->with($user)
                    ->willReturn(new JWTAuthenticationSuccessResponse('1'));

        $command = new CreateUserCommand(new UserRequestDTO('test-name', 'test-email', 'test-phone', 'test-password'));

        $actual = (new CreateUserHandler($successHandler, $userMaker))($command);

        $this->assertEquals('{"token":"1"}', $actual->getContent());
    }
}

<?php

namespace App\Tests\Unit\User\Application\UseCase\Query\FindUserByName;

use App\User\Application\DTO\UserDTOTransformer;
use App\User\Application\DTO\UserResponseDTO;
use App\User\Application\UseCase\Query\User\FindUserByName\FindUserByNameQuery;
use App\User\Application\UseCase\Query\User\FindUserByName\FindUserByNameQueryHandler;
use App\User\Domain\Aggregate\User\Entity\User;
use App\User\Domain\Repository\UserRepositoryInterface;
use PHPUnit\Framework\TestCase;

class FindUserByNameQueryHandlerTest extends TestCase
{
    public function testInvoke(): void
    {
        $userRepository = $this->createMock(UserRepositoryInterface::class);
        $userDTOTransformer = $this->createMock(UserDTOTransformer::class);
        $user = $this->createMock(User::class);
        $time = new \DateTimeImmutable();
        $user->expects($this->once())
             ->method('getUlid')
             ->willReturn('test-ulid');

        $userRepository->expects($this->once())
             ->method('findOneByName')
             ->with('test-name')
             ->willReturn($user);

        $userDTOTransformer->expects($this->once())
             ->method('fromEntityToDTO')
             ->with($user)
             ->willReturn(new UserResponseDTO('test-name', $time->getTimestamp()));

        $actual = (new FindUserByNameQueryHandler($userRepository, $userDTOTransformer))(new FindUserByNameQuery('test-name'));

        $this->assertEquals('test-ulid', $actual->getUserUld());

        $this->assertEquals('test-name', $actual->DTO->name);

        $this->assertEquals($time->getTimestamp(), $actual->DTO->registrationDate);

        $this->assertEquals(0, $actual->DTO->productCount);
    }
}

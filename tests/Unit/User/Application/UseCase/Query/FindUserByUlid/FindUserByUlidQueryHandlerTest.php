<?php

namespace App\Tests\Unit\User\Application\UseCase\Query\FindUserByUlid;

use App\User\Application\DTO\UserDTOTransformer;
use App\User\Application\DTO\UserResponseDTO;
use App\User\Application\UseCase\Query\User\FindUserByUlid\FindUserByUlidQuery;
use App\User\Application\UseCase\Query\User\FindUserByUlid\FindUserByUlidQueryHandler;
use App\User\Application\UseCase\Query\User\FindUserByUlid\FindUserByUlidQueryResult;
use App\User\Domain\Aggregate\User\Entity\User;
use App\User\Domain\Repository\UserRepositoryInterface;
use PHPUnit\Framework\TestCase;

class FindUserByUlidQueryHandlerTest extends TestCase
{
    public function testInvoke(): void
    {
        $user = $this->createMock(User::class);
        $userRepository = $this->createMock(UserRepositoryInterface::class);
        $userDTOTransformer = $this->createMock(UserDTOTransformer::class);
        $time = new \DateTimeImmutable();
        $userRepository->expects($this->once())
                ->method('findOneByUlid')
                ->with('test-ulid')
                ->willReturn($user);

        $userDTOTransformer->expects($this->once())
                ->method('fromEntityToDTO')
                ->with($user)
                ->willReturn(new UserResponseDTO('test-name', $time->getTimestamp(), 50));

        $actual = (new FindUserByUlidQueryHandler($userRepository, $userDTOTransformer))(new FindUserByUlidQuery('test-ulid'));

        $this->assertEquals(FindUserByUlidQueryResult::class, get_class($actual));
        $this->assertEquals('test-name', $actual->userResponseDTO->name);
        $this->assertEquals($time->getTimestamp(), $actual->userResponseDTO->registrationDate);
        $this->assertEquals(50, $actual->userResponseDTO->productCount);
    }
}

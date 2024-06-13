<?php

namespace App\Tests\Unit\User\Infrastructure\API\User\UserDataByUlid;

use App\Shared\Application\Query\QueryBusInterface;
use App\User\Application\DTO\UserResponseDTO;
use App\User\Application\UseCase\Query\User\FindUserByUlid\FindUserByUlidQuery;
use App\User\Application\UseCase\Query\User\FindUserByUlid\FindUserByUlidQueryResult;
use App\User\Infrastructure\API\User\UserDataByUlid\UserDataByUlidAPI;
use PHPUnit\Framework\TestCase;

class UserDataByUlidAPITest extends TestCase
{
    public function testGetUserDataByUlid(): void
    {
        $queryBus = $this->createMock(QueryBusInterface::class);

        $query = new FindUserByUlidQuery('test');

        $queryBus->expects($this->once())
                   ->method('execute')
                   ->with($query)
                   ->willReturn(new FindUserByUlidQueryResult(new UserResponseDTO('testing', 1, 1)));

        $actual = (new UserDataByUlidAPI($queryBus))->getUserDataByUlid('test');

        $this->assertEquals(UserResponseDTO::class, get_class($actual));
        $this->assertEquals(
            expected: new UserResponseDTO('testing', 1, 1),
            actual: $actual);
    }
}

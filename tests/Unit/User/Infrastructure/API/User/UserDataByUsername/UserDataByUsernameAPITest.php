<?php

namespace App\Tests\Unit\User\Infrastructure\API\User\UserDataByUsername;

use App\Shared\Application\Query\QueryBusInterface;
use App\User\Application\DTO\UserResponseDTO;
use App\User\Application\UseCase\Query\User\FindUserByName\FindUserByNameQuery;
use App\User\Application\UseCase\Query\User\FindUserByName\FindUserByNameQueryResult;
use App\User\Infrastructure\API\User\UserDataByUsername\UserDataByUsernameAPI;
use PHPUnit\Framework\TestCase;

class UserDataByUsernameAPITest extends TestCase
{
    public function testGetUserDataByUsername(): void
    {
        $queryBus = $this->createMock(QueryBusInterface::class);

        $query = new FindUserByNameQuery('test-name');

        $queryBus->expects($this->once())
            ->method('execute')
            ->with($query)
            ->willReturn(
                new FindUserByNameQueryResult(new UserResponseDTO('test', 1, 1),
                    'testing'));

        $actual = (new UserDataByUsernameAPI($queryBus))->getUserDataByUsername('test-name');

        $this->assertEquals(FindUserByNameQueryResult::class, get_class($actual));
        $this->assertEquals(new UserResponseDTO('test', 1, 1), $actual->DTO);
        $this->assertEquals('testing', $actual->getUserUld());
    }
}

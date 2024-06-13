<?php

namespace App\User\Infrastructure\API\User\UserDataByUsername;

use App\ProductCatalog\Infrastructure\Adapter\User\UserAPIByUsernameInterface;
use App\Shared\Application\Query\QueryBusInterface;
use App\User\Application\UseCase\Query\User\FindUserByName\FindUserByNameQuery;
use App\User\Application\UseCase\Query\User\FindUserByName\FindUserByNameQueryResult;

final class UserDataByUsernameAPI implements UserAPIByUsernameInterface
{
    public function __construct(private readonly QueryBusInterface $queryBus)
    {
    }

    public function getUserDataByUsername(string $username): FindUserByNameQueryResult
    {
        $query = new FindUserByNameQuery($username);
        /**
         * @var FindUserByNameQueryResult $result;
         */
        $result = $this->queryBus->execute($query);

        return $result;
    }
}

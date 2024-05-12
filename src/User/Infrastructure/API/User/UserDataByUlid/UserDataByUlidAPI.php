<?php

namespace App\User\Infrastructure\API\User\UserDataByUlid;

use App\ProductCatalog\Infrastructure\Adapter\User\UserAPIByUlidInterface;
use App\Shared\Application\Query\QueryBusInterface;
use App\User\Application\DTO\UserResponseDTO;
use App\User\Application\UseCase\Query\User\FindUserByUlid\FindUserByUlidQuery;
use App\User\Application\UseCase\Query\User\FindUserByUlid\FindUserByUlidQueryResult;

class UserDataByUlidAPI implements UserAPIByUlidInterface
{
    public function __construct(private readonly QueryBusInterface $queryBus)
    {
    }

    public function getUserDataByUlid(string $user_ulid): UserResponseDTO
    {
        $query = new FindUserByUlidQuery($user_ulid);
        /**
         * @var FindUserByUlidQueryResult $result
         */
        $result = $this->queryBus->execute($query);

        return $result->userResponseDTO;
    }
}

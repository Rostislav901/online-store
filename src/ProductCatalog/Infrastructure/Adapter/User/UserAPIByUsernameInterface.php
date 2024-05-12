<?php

namespace App\ProductCatalog\Infrastructure\Adapter\User;

use App\User\Application\UseCase\Query\User\FindUserByName\FindUserByNameQueryResult;

interface UserAPIByUsernameInterface
{
    public function getUserDataByUsername(string $username): FindUserByNameQueryResult;
}

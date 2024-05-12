<?php

namespace App\User\Application\UseCase\Query\User\FindUserByName;

use App\Shared\Application\Query\QueryInterface;

class FindUserByNameQuery implements QueryInterface
{
    public function __construct(public string $name)
    {
    }
}

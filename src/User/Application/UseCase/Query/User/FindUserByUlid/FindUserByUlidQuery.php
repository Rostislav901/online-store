<?php

namespace App\User\Application\UseCase\Query\User\FindUserByUlid;

use App\Shared\Application\Query\QueryInterface;

class FindUserByUlidQuery implements QueryInterface
{
    public function __construct(public string $ulid)
    {
    }
}

<?php

namespace App\Order\Application\UseCase\Query\FindOrderByUlid;

use App\Shared\Application\Query\QueryInterface;

class FindOrderByUlidQuery implements QueryInterface
{
    public function __construct(public string $ulid)
    {
    }
}

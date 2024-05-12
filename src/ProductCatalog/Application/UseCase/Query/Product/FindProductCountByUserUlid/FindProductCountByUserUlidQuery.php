<?php

namespace App\ProductCatalog\Application\UseCase\Query\Product\FindProductCountByUserUlid;

use App\Shared\Application\Query\QueryInterface;

class FindProductCountByUserUlidQuery implements QueryInterface
{
    public function __construct(public string $user_ulid)
    {
    }
}

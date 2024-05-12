<?php

namespace App\ProductCatalog\Application\UseCase\Query\Product\FindProductByUserUlid;

use App\Shared\Application\Query\QueryInterface;

class FindProductByUserUlidQuery implements QueryInterface
{
    public function __construct(public readonly string $user_ulid)
    {
    }
}

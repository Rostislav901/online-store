<?php

namespace App\ProductCatalog\Application\UseCase\Query\Product\FindProductByUlid;

use App\Shared\Application\Query\QueryInterface;

class FindProductByUlidQuery implements QueryInterface
{
    public function __construct(public readonly string $ulid)
    {
    }
}

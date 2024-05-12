<?php

namespace App\ProductCatalog\Application\UseCase\Query\Discount\FindDiscountByUlid;

use App\Shared\Application\Query\QueryInterface;

class FindDiscountByUlidQuery implements QueryInterface
{
    public function __construct(public string $ulid)
    {
    }
}

<?php

namespace App\ProductCatalog\Application\UseCase\Query\Discount\FindDiscountByUlid;

use App\ProductCatalog\Application\DTO\Discount\DiscountDTO;

class FindDiscountByUlidQueryResult
{
    public function __construct(public readonly DiscountDTO $discountDTO)
    {
    }
}

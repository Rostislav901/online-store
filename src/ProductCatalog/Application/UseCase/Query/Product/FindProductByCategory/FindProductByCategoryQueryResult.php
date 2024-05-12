<?php

namespace App\ProductCatalog\Application\UseCase\Query\Product\FindProductByCategory;

use App\ProductCatalog\Application\DTO\Product\ProductItemDTO;
use App\Shared\Application\Query\QueryInterface;

class FindProductByCategoryQueryResult implements QueryInterface
{
    /**
     * @param ProductItemDTO[] $products
     */
    public function __construct(public array $products)
    {
    }
}

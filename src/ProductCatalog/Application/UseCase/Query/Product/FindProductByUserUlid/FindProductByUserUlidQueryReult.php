<?php

namespace App\ProductCatalog\Application\UseCase\Query\Product\FindProductByUserUlid;

use App\ProductCatalog\Application\DTO\Product\ProductItemDTO;

class FindProductByUserUlidQueryReult
{
    /**
     * @param ProductItemDTO[] $products
     */
    public function __construct(public array $products)
    {
    }
}

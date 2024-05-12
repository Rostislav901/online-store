<?php

namespace App\ProductCatalog\Application\UseCase\Query\Product\FindProductByUserUlidAndProductName;

use App\ProductCatalog\Application\DTO\Product\ProductDTO;
use App\Shared\Application\Query\QueryInterface;

class FindProductByUserUlidAndProductNameQueryResult implements QueryInterface
{
    public function __construct(public ProductDTO $productDTO)
    {
    }
}

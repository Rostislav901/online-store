<?php

namespace App\ProductCatalog\Application\UseCase\Query\Product\FindProductBySearch;

use App\ProductCatalog\Application\DTO\Product\ProductItemDTO;
use App\Shared\Application\Query\QueryInterface;

class FindProductBySearchQueryResult implements QueryInterface
{
    /**
     * @param ProductItemDTO[] $products
     */
    public function __construct(private array $products)
    {
    }

    public function getProducts(): array
    {
        return $this->products;
    }
}

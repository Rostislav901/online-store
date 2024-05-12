<?php

namespace App\ProductCatalog\Application\UseCase\Query\Product\FindProductByUlid;

use App\ProductCatalog\Application\DTO\Product\ProductDTO;
use App\Shared\Application\Query\QueryInterface;

class FindProductByUlidQueryResult implements QueryInterface
{
    public function __construct(public ProductDTO $productDTO, public string $user_ulid)
    {
    }
}

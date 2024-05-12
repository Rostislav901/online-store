<?php

namespace App\User\Infrastructure\Adapter\Product;

use App\ProductCatalog\Application\UseCase\Query\Product\FindProductCountByUserUlid\FindProductCountByUserUlidQueryResult;

class ProductAdapter
{
    public function __construct(private readonly ProductAPIByUserUlidInterface $productAPIByUserUlid)
    {
    }

    public function getProductCountDataByUserUlid(string $ulid): FindProductCountByUserUlidQueryResult
    {
        return $this->productAPIByUserUlid->productCountByUserUlid($ulid);
    }
}

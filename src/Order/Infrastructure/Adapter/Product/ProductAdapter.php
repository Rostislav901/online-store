<?php

namespace App\Order\Infrastructure\Adapter\Product;

use App\ProductCatalog\Application\UseCase\Query\Product\FindProductByUlid\FindProductByUlidQueryResult;

class ProductAdapter
{
    public function __construct(private readonly OrderProductAPIInterface $orderProductAPI)
    {
    }

    public function getProductDataByUlid(string $product_ulid): FindProductByUlidQueryResult
    {
        return $this->orderProductAPI->getProductByUlid($product_ulid);
    }
}

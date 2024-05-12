<?php

namespace App\Order\Infrastructure\Adapter\Product;

use App\ProductCatalog\Application\UseCase\Query\Product\FindProductByUlid\FindProductByUlidQueryResult;

interface OrderProductAPIInterface
{
    public function getProductByUlid(string $product_ulid): FindProductByUlidQueryResult;
}

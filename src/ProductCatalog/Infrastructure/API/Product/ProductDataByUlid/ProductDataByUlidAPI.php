<?php

namespace App\ProductCatalog\Infrastructure\API\Product\ProductDataByUlid;

use App\Basket\Infrastructure\Adapter\Product\BasketProductsAPIInterface;
use App\Order\Infrastructure\Adapter\Product\OrderProductAPIInterface;
use App\ProductCatalog\Application\UseCase\Query\Product\FindProductByUlid\FindProductByUlidQuery;
use App\ProductCatalog\Application\UseCase\Query\Product\FindProductByUlid\FindProductByUlidQueryResult;
use App\Shared\Infrastructure\Bus\QueryBus;

class ProductDataByUlidAPI implements BasketProductsAPIInterface, OrderProductAPIInterface
{
    public function __construct(private readonly QueryBus $queryBus)
    {
    }

    public function getProductByUlid(string $product_ulid): FindProductByUlidQueryResult
    {
        $query = new FindProductByUlidQuery($product_ulid);

        /**
         * @var FindProductByUlidQueryResult $res
         */
        $res = $this->queryBus->execute($query);

        return $res;
    }
}

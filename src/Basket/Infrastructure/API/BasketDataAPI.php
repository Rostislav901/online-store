<?php

namespace App\Basket\Infrastructure\API;

use App\Basket\Application\UseCase\Query\FindBasket\FindBasketQuery;
use App\Basket\Application\UseCase\Query\FindBasket\FindBasketQueryResult;
use App\Order\Infrastructure\Adapter\Basket\OrderBasketAPIInterface;
use App\Shared\Infrastructure\Bus\QueryBus;

class BasketDataAPI implements OrderBasketAPIInterface
{
    public function __construct(private readonly QueryBus $queryBus)
    {
    }

    public function getBasketData(): array
    {
        $query = new FindBasketQuery();

        /**
         * @var FindBasketQueryResult $result
         */
        $result = $this->queryBus->execute($query);

        return $result->products;
    }
}

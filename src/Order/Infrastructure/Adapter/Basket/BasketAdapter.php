<?php

namespace App\Order\Infrastructure\Adapter\Basket;

use App\Basket\Application\DTO\BasketProduct\BasketProductDTO;

class BasketAdapter
{
    public function __construct(private readonly OrderBasketAPIInterface $basketAPI)
    {
    }

    /**
     * @return BasketProductDTO[]
     */
    public function getBasketData(): array
    {
        return $this->basketAPI->getBasketData();
    }
}

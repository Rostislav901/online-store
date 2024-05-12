<?php

namespace App\Order\Infrastructure\Adapter\Basket;

use App\Basket\Application\DTO\BasketProduct\BasketProductDTO;

interface OrderBasketAPIInterface
{
    /**
     * @return BasketProductDTO[]
     */
    public function getBasketData(): array;
}

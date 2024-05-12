<?php

namespace App\Basket\Application\UseCase\Query\FindBasket;

use App\Basket\Application\DTO\BasketProduct\BasketProductDTO;

class FindBasketQueryResult
{
    /**
     * @param BasketProductDTO[] $products
     */
    public function __construct(public readonly array $products)
    {
    }
}

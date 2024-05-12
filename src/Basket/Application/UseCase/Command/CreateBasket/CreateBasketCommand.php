<?php

namespace App\Basket\Application\UseCase\Command\CreateBasket;

use App\Basket\Application\DTO\BasketProduct\BasketProductContainer;
use App\Basket\Application\DTO\BasketProduct\BasketProductDTO;
use App\Shared\Application\Command\CommandInterface;

class CreateBasketCommand implements CommandInterface
{
    //    /**
    //     * @param BasketProductDTO[] $products
    //     */
    public function __construct(public BasketProductContainer $container)
    {
    }
}

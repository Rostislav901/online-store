<?php

namespace App\Basket\Infrastructure\Exception;

class BasketProductCountException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('The quantity of items in the cart exceeds the quantity available from the seller');
    }
}

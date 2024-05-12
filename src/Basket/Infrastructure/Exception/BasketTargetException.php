<?php

namespace App\Basket\Infrastructure\Exception;

class BasketTargetException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('You cannot add your item to the cart.');
    }
}

<?php

namespace App\Basket\Application\Exception;

class BasketEmptyException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Basket empty');
    }
}

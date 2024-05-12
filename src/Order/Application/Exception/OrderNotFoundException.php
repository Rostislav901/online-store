<?php

namespace App\Order\Application\Exception;

class OrderNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Order not found');
    }
}

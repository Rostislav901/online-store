<?php

namespace App\ProductCatalog\Application\Exception;

class DiscountNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Discount not found');
    }
}

<?php

namespace App\ProductCatalog\Application\Exception;

class ProductNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Product not found');
    }
}

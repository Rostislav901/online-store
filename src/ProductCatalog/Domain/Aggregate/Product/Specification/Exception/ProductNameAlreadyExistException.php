<?php

namespace App\ProductCatalog\Domain\Aggregate\Product\Specification\Exception;

class ProductNameAlreadyExistException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('The product name must be unique within each user\'s account');
    }
}

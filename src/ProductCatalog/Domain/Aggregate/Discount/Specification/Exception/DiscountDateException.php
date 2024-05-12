<?php

namespace App\ProductCatalog\Domain\Aggregate\Discount\Specification\Exception;

class DiscountDateException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('End-date must bee after start-date');
    }
}

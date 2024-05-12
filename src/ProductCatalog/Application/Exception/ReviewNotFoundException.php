<?php

namespace App\ProductCatalog\Application\Exception;

class ReviewNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Review not found');
    }
}

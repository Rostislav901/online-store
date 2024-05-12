<?php

namespace App\ProductCatalog\Domain\Aggregate\Review\Specification\Exception;

class ReviewTargetException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('You cannot leave a review on your own product');
    }
}

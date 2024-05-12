<?php

namespace App\ProductCatalog\Application\Exception;

class CategoryNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Category not found');
    }
}

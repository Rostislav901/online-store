<?php

namespace App\ProductCatalog\Application\UseCase\Query\Product\FindProductByCategory;

use App\Shared\Application\Query\QueryInterface;

class FindProductByCategoryQuery implements QueryInterface
{
    public function __construct(private readonly string $category)
    {
    }

    public function getCategory(): string
    {
        return $this->category;
    }
}

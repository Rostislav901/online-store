<?php

namespace App\ProductCatalog\Application\UseCase\Query\Product\FindProductCountByCategory;

use App\Shared\Application\Query\QueryInterface;

class FindProductCountByCategoryQuery implements QueryInterface
{
    public function __construct(private readonly string $category)
    {
    }

    public function getCategory(): string
    {
        return $this->category;
    }
}

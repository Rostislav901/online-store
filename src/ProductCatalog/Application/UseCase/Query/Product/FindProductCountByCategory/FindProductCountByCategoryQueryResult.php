<?php

namespace App\ProductCatalog\Application\UseCase\Query\Product\FindProductCountByCategory;

use App\Shared\Application\Query\QueryInterface;

class FindProductCountByCategoryQueryResult implements QueryInterface
{
    public function __construct(private readonly ?int $count)
    {
    }

    public function getCount(): int
    {
        return $this->count;
    }
}

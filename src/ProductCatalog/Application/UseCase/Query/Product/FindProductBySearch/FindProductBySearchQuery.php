<?php

namespace App\ProductCatalog\Application\UseCase\Query\Product\FindProductBySearch;

use App\Shared\Application\Query\QueryInterface;

class FindProductBySearchQuery implements QueryInterface
{
    public function __construct(public readonly string $search)
    {
    }
}

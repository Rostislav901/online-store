<?php

namespace App\ProductCatalog\Application\UseCase\Query\Product\FindProductCountByUserUlid;

use App\Shared\Application\Query\QueryInterface;

class FindProductCountByUserUlidQueryResult implements QueryInterface
{
    public function __construct(private readonly ?int $count)
    {
    }

    public function getCount(): int
    {
        return $this->count;
    }
}

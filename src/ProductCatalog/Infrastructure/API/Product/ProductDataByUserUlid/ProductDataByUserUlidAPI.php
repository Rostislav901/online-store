<?php

namespace App\ProductCatalog\Infrastructure\API\Product\ProductDataByUserUlid;

use App\ProductCatalog\Application\UseCase\Query\Product\FindProductCountByUserUlid\FindProductCountByUserUlidQuery;
use App\ProductCatalog\Application\UseCase\Query\Product\FindProductCountByUserUlid\FindProductCountByUserUlidQueryResult;
use App\Shared\Infrastructure\Bus\QueryBus;
use App\User\Infrastructure\Adapter\Product\ProductAPIByUserUlidInterface;

class ProductDataByUserUlidAPI implements ProductAPIByUserUlidInterface
{
    public function __construct(private readonly QueryBus $queryBus)
    {
    }

    public function productCountByUserUlid(string $user_ulid): FindProductCountByUserUlidQueryResult
    {
        $query = new FindProductCountByUserUlidQuery($user_ulid);

        return $this->queryBus->execute($query);
    }
}

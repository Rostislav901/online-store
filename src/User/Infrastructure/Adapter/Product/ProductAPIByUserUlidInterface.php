<?php

namespace App\User\Infrastructure\Adapter\Product;

use App\ProductCatalog\Application\UseCase\Query\Product\FindProductCountByUserUlid\FindProductCountByUserUlidQueryResult;

interface ProductAPIByUserUlidInterface
{
    public function productCountByUserUlid(string $user_ulid): FindProductCountByUserUlidQueryResult;
}

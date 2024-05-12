<?php

namespace App\ProductCatalog\Application\UseCase\Query\Product\FindProductByUserUlidAndProductName;

use App\Shared\Application\Query\QueryInterface;

class FindProductByUserUlidAndProductNameQuery implements QueryInterface
{
    public function __construct(
        public readonly string $user_ulid,
        public readonly string $productName)
    {
    }
}

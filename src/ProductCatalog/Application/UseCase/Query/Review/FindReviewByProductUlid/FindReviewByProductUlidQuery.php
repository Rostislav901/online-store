<?php

namespace App\ProductCatalog\Application\UseCase\Query\Review\FindReviewByProductUlid;

use App\Shared\Application\Query\QueryInterface;

class FindReviewByProductUlidQuery implements QueryInterface
{
    public function __construct(public readonly string $product_ulid)
    {
    }
}

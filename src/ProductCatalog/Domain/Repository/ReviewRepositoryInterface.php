<?php

namespace App\ProductCatalog\Domain\Repository;

use App\ProductCatalog\Domain\Aggregate\Review\Entity\Review;

interface ReviewRepositoryInterface
{
    /**
     * @return Review[]
     */
    public function findByProductUlid(string $product_ulid): array;

    public function add(Review $review): void;
}

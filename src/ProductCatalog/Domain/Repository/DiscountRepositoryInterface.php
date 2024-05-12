<?php

namespace App\ProductCatalog\Domain\Repository;

use App\ProductCatalog\Domain\Aggregate\Discount\Entity\Discount;

interface DiscountRepositoryInterface
{
    public function findDiscountByUlid(string $ulid): ?Discount;
}

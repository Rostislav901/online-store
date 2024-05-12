<?php

namespace App\ProductCatalog\Domain\Aggregate\Review\Specification\Interface;

interface ReviewTargetSpecificationInterface
{
    public function targetValid(string $productUlid, string $user_ulid): void;
}

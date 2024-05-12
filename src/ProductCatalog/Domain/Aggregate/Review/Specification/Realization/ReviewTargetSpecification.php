<?php

namespace App\ProductCatalog\Domain\Aggregate\Review\Specification\Realization;

use App\ProductCatalog\Domain\Aggregate\Review\Specification\Exception\ReviewTargetException;
use App\ProductCatalog\Domain\Aggregate\Review\Specification\Interface\ReviewTargetSpecificationInterface;
use App\ProductCatalog\Domain\Repository\ProductRepositoryInterface;

class ReviewTargetSpecification implements ReviewTargetSpecificationInterface
{
    public function __construct(private readonly ProductRepositoryInterface $productRepository)
    {
    }

    public function targetValid(string $productUlid, string $user_ulid): void
    {
        if ($this->productRepository->existByUserUlidAndProductUlid($user_ulid, $productUlid)) {
            throw new ReviewTargetException();
        }
    }
}

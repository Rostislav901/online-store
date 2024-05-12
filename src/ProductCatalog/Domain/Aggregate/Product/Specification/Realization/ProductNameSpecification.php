<?php

namespace App\ProductCatalog\Domain\Aggregate\Product\Specification\Realization;

use App\ProductCatalog\Domain\Aggregate\Product\Specification\Exception\ProductNameAlreadyExistException;
use App\ProductCatalog\Domain\Aggregate\Product\Specification\Interface\ProductNameSpecificationInterface;
use App\ProductCatalog\Domain\Repository\ProductRepositoryInterface;

class ProductNameSpecification implements ProductNameSpecificationInterface
{
    public function __construct(private readonly ProductRepositoryInterface $productRepository)
    {
    }

    public function productNameInUserProductsIsUnique(string $productName, string $user_ulid): void
    {
        if ($this->productRepository->existByNameAndUserUlid($productName, $user_ulid)) {
            throw new ProductNameAlreadyExistException();
        }
    }
}

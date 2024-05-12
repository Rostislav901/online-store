<?php

namespace App\ProductCatalog\Domain\Aggregate\Product\Specification\Interface;

interface ProductNameSpecificationInterface
{
    public function productNameInUserProductsIsUnique(string $productName, string $user_ulid): void;
}

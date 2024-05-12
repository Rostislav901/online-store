<?php

namespace App\ProductCatalog\Domain\Aggregate\Product\Specification;

use App\ProductCatalog\Domain\Aggregate\Product\Specification\Interface\ProductNameSpecificationInterface;

class ProductSpecification
{
    public function __construct(private readonly ProductNameSpecificationInterface $nameSpecification)
    {
    }

    public function getNameSpecification(): ProductNameSpecificationInterface
    {
        return $this->nameSpecification;
    }
}

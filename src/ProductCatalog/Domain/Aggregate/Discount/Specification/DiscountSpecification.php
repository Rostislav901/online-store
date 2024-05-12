<?php

namespace App\ProductCatalog\Domain\Aggregate\Discount\Specification;

use App\ProductCatalog\Domain\Aggregate\Discount\Specification\Interface\DiscountDateSpecificationInterface;

class DiscountSpecification
{
    public function __construct(private readonly DiscountDateSpecificationInterface $dateSpecification)
    {
    }

    public function getDateSpecification(): DiscountDateSpecificationInterface
    {
        return $this->dateSpecification;
    }
}

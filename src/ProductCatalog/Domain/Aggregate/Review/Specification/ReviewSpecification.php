<?php

namespace App\ProductCatalog\Domain\Aggregate\Review\Specification;

use App\ProductCatalog\Domain\Aggregate\Review\Specification\Interface\ReviewTargetSpecificationInterface;

class ReviewSpecification
{
    public function __construct(private readonly ReviewTargetSpecificationInterface $reviewTargetSpecification)
    {
    }

    public function getReviewTargetSpecification(): ReviewTargetSpecificationInterface
    {
        return $this->reviewTargetSpecification;
    }
}

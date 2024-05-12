<?php

namespace App\ProductCatalog\Domain\Aggregate\Discount\Specification\Realization;

use App\ProductCatalog\Domain\Aggregate\Discount\Specification\Exception\DiscountDateException;
use App\ProductCatalog\Domain\Aggregate\Discount\Specification\Interface\DiscountDateSpecificationInterface;

class DiscountDateSpecification implements DiscountDateSpecificationInterface
{
    public function endDateAfterStartDate(\DateTime $startDate, \DateTime $endDate): void
    {
        if ($startDate->getTimestamp() >= $endDate->getTimestamp()) {
            throw new DiscountDateException();
        }
    }
}

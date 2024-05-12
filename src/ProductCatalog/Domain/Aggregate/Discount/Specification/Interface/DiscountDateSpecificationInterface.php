<?php

namespace App\ProductCatalog\Domain\Aggregate\Discount\Specification\Interface;

interface DiscountDateSpecificationInterface
{
    public function endDateAfterStartDate(\DateTime $startDate, \DateTime $endDate): void;
}

<?php

namespace App\ProductCatalog\Domain\Factory;

use App\ProductCatalog\Domain\Aggregate\Discount\Entity\Discount;
use App\ProductCatalog\Domain\Aggregate\Discount\Specification\DiscountSpecification;
use App\Shared\Domain\Security\UserFetcherInterface;
use App\Shared\Domain\Specification\UlidSpecification;
use App\Shared\Domain\VO\UserUlid;

class DiscountFactory
{
    public function __construct(
        private readonly UserFetcherInterface $userFetcher,
        private readonly DiscountSpecification $discountSpecification,
        private readonly UlidSpecification $ulidSpecification)
    {
    }

    public function create(float $discount, \DateTime $startDate, \DateTime $endDate): Discount
    {
        return new Discount(
            discount: $discount,
            user_ulid: new UserUlid($this->userFetcher->getUserAuth()->getUlid(), $this->ulidSpecification),
            startDate: $startDate,
            endDate: $endDate,
            discountSpecification: $this->discountSpecification
        );
    }
}

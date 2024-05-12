<?php

namespace App\ProductCatalog\Domain\Service;

use App\ProductCatalog\Domain\Factory\DiscountFactory;
use App\ProductCatalog\Domain\Repository\DiscountRepositoryInterface;

class DiscountMaker
{
    public function __construct(
        private readonly DiscountFactory $discountFactory,
        private readonly DiscountRepositoryInterface $discountRepository)
    {
    }

    public function makeDiscountAndPersist(
        float $discount,
        \DateTime $startDate,
        \DateTime $endDate
    ): string {
        $discountEntity = $this->discountFactory->create(
            discount: $discount,
            startDate: $startDate,
            endDate: $endDate
        );

        $this->discountRepository->getEntityManager()->persist($discountEntity);

        return $discountEntity->getUlid();
    }
}

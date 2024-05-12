<?php

namespace App\ProductCatalog\Application\DTO\Discount;

use App\ProductCatalog\Domain\Aggregate\Discount\Entity\Discount;

class DiscountDTOTransformer
{
    public function fromEntityToDTO(Discount $entity): DiscountDTO
    {
        return new DiscountDTO(
            discount: $entity->getDiscount(),
            startDate: $entity->getStartDate()->format('Y-m-d'),
            endDate: $entity->getEndDate()->format('Y-m-d')
        );
    }
}

<?php

namespace App\ProductCatalog\Application\UseCase\Command\Discount\CreateDiscountOnCategory;

use App\ProductCatalog\Application\DTO\Discount\DiscountDTO;
use App\Shared\Application\Command\CommandInterface;

class CreateDiscountOnCategoryCommand implements CommandInterface
{
    public function __construct(
        public readonly string $category,
        public readonly DiscountDTO $discountDTO)
    {
    }
}

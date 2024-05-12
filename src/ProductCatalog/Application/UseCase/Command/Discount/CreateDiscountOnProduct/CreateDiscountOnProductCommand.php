<?php

namespace App\ProductCatalog\Application\UseCase\Command\Discount\CreateDiscountOnProduct;

use App\ProductCatalog\Application\DTO\Discount\DiscountDTO;
use App\Shared\Application\Command\CommandInterface;

class CreateDiscountOnProductCommand implements CommandInterface
{
    public function __construct(public string $productName, public DiscountDTO $discountDTO)
    {
    }
}

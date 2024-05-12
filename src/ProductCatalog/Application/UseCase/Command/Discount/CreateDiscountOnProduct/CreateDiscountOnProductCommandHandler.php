<?php

namespace App\ProductCatalog\Application\UseCase\Command\Discount\CreateDiscountOnProduct;

use App\ProductCatalog\Domain\Service\DiscountMaker;
use App\ProductCatalog\Domain\Service\ProductDiscountSetter;
use App\Shared\Application\Command\CommandHandlerInterface;

class CreateDiscountOnProductCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly DiscountMaker $discountMaker,
        private readonly ProductDiscountSetter $discountSetter)
    {
    }

    public function __invoke(CreateDiscountOnProductCommand $command): CreateDiscountOnProductCommandResult
    {
        $productName = $command->productName;
        $discountDto = $command->discountDTO;

        $discount_ulid = $this->discountMaker->makeDiscountAndPersist(
            discount: $discountDto->getDiscount(),
            startDate: $discountDto->getStartDateValue(),
            endDate: $discountDto->getEndDateValue()
        );
        $this->discountSetter->setDiscount($discount_ulid);

        $this->discountSetter->setDiscountOnProduct($productName);

        return new CreateDiscountOnProductCommandResult();
    }
}

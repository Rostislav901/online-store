<?php

namespace App\ProductCatalog\Application\UseCase\Command\Discount\CreateDiscountOnCategory;

use App\ProductCatalog\Application\Exception\ProductNotFoundException;
use App\ProductCatalog\Domain\Repository\CategoryRepositoryInterface;
use App\ProductCatalog\Domain\Repository\ProductRepositoryInterface;
use App\ProductCatalog\Domain\Service\DiscountMaker;
use App\ProductCatalog\Domain\Service\ProductDiscountSetter;
use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\Security\UserFetcherInterface;

class CreateDiscountOnCategoryCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly DiscountMaker $discountMaker,
        private readonly ProductDiscountSetter $discountSetter,
        private readonly UserFetcherInterface $userFetcher,
        private readonly CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function __invoke(CreateDiscountOnCategoryCommand $command): CreateDiscountOnCategoryCommandResult
    {
        $category = $command->category;

        $discountDto = $command->discountDTO;

        $categoryId = $this->categoryRepository->getCategoryByTitle($category)->getId();
        $products = $this->productRepository->findByCategoryAndUserUlid($categoryId, $this->userFetcher->getUserAuth()->getUlid());
        if (0 === count($products)) {
            throw new ProductNotFoundException();
        }
        $discount_ulid = $this->discountMaker->makeDiscountAndPersist(
            discount: $discountDto->getDiscount(),
            startDate: $discountDto->getStartDateValue(),
            endDate: $discountDto->getEndDateValue()
        );
        $this->discountSetter->setDiscount($discount_ulid);
        foreach ($products as $product) {
            $this->discountSetter->setDiscountOnProduct($product->getName());
        }

        return new CreateDiscountOnCategoryCommandResult();
    }
}

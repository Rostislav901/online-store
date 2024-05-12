<?php

namespace App\ProductCatalog\Application\DTO\Product;

use App\ProductCatalog\Application\Service\ReviewService;
use App\ProductCatalog\Application\UseCase\Query\Discount\FindDiscountByUlid\FindDiscountByUlidQuery;
use App\ProductCatalog\Application\UseCase\Query\Discount\FindDiscountByUlid\FindDiscountByUlidQueryResult;
use App\ProductCatalog\Domain\Aggregate\Product\Entity\Product;
use App\Shared\Application\Query\QueryBusInterface;

class ProductDTOTransformer
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
        private readonly ReviewService $reviewService)
    {
    }

    /**
     * @param Product[] $entities
     *
     * @return ProductItemDTO[]
     */
    public function fromProductEntityList(array $entities): array
    {
        $productDtoList = [];
        foreach ($entities as $entity) {
            $productDtoList[] = $this->fromProductEntity($entity);
        }

        return $productDtoList;
    }

    public function fromProductEntity(Product $product): ProductItemDTO
    {
        $discount = 0;
        $price = $product->getPrice();
        $discount_ulid = $product->getDiscountUlid()->getUlid();
        if (null !== $discount_ulid) {
            $findDiscount = new FindDiscountByUlidQuery($discount_ulid);
            /**
             * @var FindDiscountByUlidQueryResult $result
             */
            $result = $this->queryBus->execute($findDiscount);
            $discount = $result->discountDTO->discount;
        }

        $priceAfterDiscount = $price - $price * $discount;
        $reviewInfo = $this->reviewService->getReviewDataByProductUlid($product->getUlid());

        return new ProductItemDTO(
            name: $product->getName(),
            price: $price,
            discount: $discount,
            priceAfterDiscount: $priceAfterDiscount,
            rating: $reviewInfo->getAverageRating(),
            reviewCount: $reviewInfo->getCount(),
            isActive: $product->getIsActive(),
            ulid: $product->getUlid(),
            currency: $product->getCurrency()->value
        );
    }
}

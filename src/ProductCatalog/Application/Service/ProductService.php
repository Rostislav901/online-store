<?php

namespace App\ProductCatalog\Application\Service;

use App\ProductCatalog\Application\DTO\Characteristic\CharacteristicDTOTransformer;
use App\ProductCatalog\Application\DTO\Characteristic\CharacteristicItemDTO;
use App\ProductCatalog\Application\DTO\Discount\DiscountDTO;
use App\ProductCatalog\Application\DTO\Image\ImageDTOTransformer;
use App\ProductCatalog\Application\DTO\Image\ImageItemDTO;
use App\ProductCatalog\Application\DTO\Product\ProductDTO;
use App\ProductCatalog\Application\UseCase\Query\Discount\FindDiscountByUlid\FindDiscountByUlidQuery;
use App\ProductCatalog\Application\UseCase\Query\Discount\FindDiscountByUlid\FindDiscountByUlidQueryResult;
use App\ProductCatalog\Domain\Aggregate\Product\Entity\Product;
use App\ProductCatalog\Domain\Repository\CategoryRepositoryInterface;
use App\Shared\Application\Query\QueryBusInterface;

class ProductService
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
        private readonly CharacteristicDTOTransformer $characteristicDTOTransformer,
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly ReviewService $reviewService,
        private readonly ImageDTOTransformer $imageDTOTransformer)
    {
    }

    public function productDTOByEntity(Product $product): ProductDTO
    {
        $characteristics = $this->characteristicDTOTransformer
            ->fromEntityListToDTOItemList($product->getCharacteristics()->toArray());
        $images = $this->imageDTOTransformer->fromEntityListToDTOItemList($product->getImages()->toArray());
        $discount_ulid = $product->getDiscountUlid()->getUlid();
        $discountDTO = null;
        if (null !== $discount_ulid) {
            $findDiscount = new FindDiscountByUlidQuery($discount_ulid);
            /**
             * @var FindDiscountByUlidQueryResult $result
             */
            $result = $this->queryBus->execute($findDiscount);
            $discountDTO = $result->discountDTO;
        }

        return $this->mapToDTO($images, $characteristics, $discountDTO, $product);
    }

    /**
     * @param ImageItemDTO[]          $images
     * @param CharacteristicItemDTO[] $char
     */
    public function mapToDTO(array $images, array $char, ?DiscountDTO $discountDTO, Product $product): ProductDTO
    {
        $category = $this->categoryRepository->getCategoryById($product->getCategoryId());
        $reviewData = $this->reviewService->getReviewDataByProductUlid($product->getUlid());
        $discount = 0;
        $discountStartDate = null;
        $discountEndDate = null;
        if (null !== $discountDTO) {
            $discount = $discountDTO->discount;
            $discountStartDate = $discountDTO->getStartDateValue()->getTimestamp();
            $discountEndDate = $discountDTO->getEndDateValue()->getTimestamp();
        }
        $price = $product->getPrice();
        $priceAfterDiscount = $price - $discount * $price;

        return new ProductDTO(
            name: $product->getName(),
            price: $price,
            discount: $discount,
            discountDateStart: $discountStartDate,
            discountDateEnd: $discountEndDate,
            priceAfterDiscount: $priceAfterDiscount,
            currency: $product->getCurrency()->value,
            dateCreate: $product->getCreatedAt()->getTimestamp(),
            isActive: $product->getIsActive(),
            stock: $product->getStock(),
            category: $category->getTitle(),
            reviewCount: $reviewData->getCount(),
            rating: $reviewData->getAverageRating(),
            characteristics: $char,
            images: $images
        );
    }
}

<?php

namespace App\Basket\Infrastructure\Adapter\Product;

use App\Basket\Application\DTO\BasketProduct\BasketProductDTO;
use App\Basket\Infrastructure\Exception\BasketProductCountException;
use App\Basket\Infrastructure\Exception\BasketTargetException;
use App\Basket\Infrastructure\Recommendation\RecommendationService;
use App\Shared\Domain\Security\UserFetcherInterface;

class ProductAdapter
{
    public function __construct(
        private readonly BasketProductsAPIInterface $API,
        private readonly RecommendationService $recommendationService,
        private readonly UserFetcherInterface $userFetcher)
    {
    }

    /**
     * @param BasketProductDTO[] $basketProducts
     */
    public function productsVerify(array $basketProducts): array
    {
        foreach ($basketProducts as $basketProduct) {
            if ('true' == $_ENV['MICRO']) {
                $productDto = $this->recommendationService->getRecommendationProductBasketDataByUlid($basketProduct->ulid);
                $productUser_ulid = $productDto->user_ulid;
            } else {
                $productData = $this->API->getProductByUlid($basketProduct->ulid);
                $productDto = $productData->productDTO;
                $productUser_ulid = $productData->user_ulid;
            }

            if ($basketProduct->count > $productDto->stock) {
                throw new BasketProductCountException();
            }

            if ($this->userFetcher->getUserAuth()->getUlid() === $productUser_ulid) {
                throw new BasketTargetException();
            }
        }

        return $basketProducts;
    }
}

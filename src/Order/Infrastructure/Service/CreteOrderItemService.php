<?php

namespace App\Order\Infrastructure\Service;

use App\Order\Application\DTO\Order\OrderItemDTORequest;
use App\Order\Infrastructure\Adapter\Basket\BasketAdapter;
use App\Order\Infrastructure\Adapter\Product\ProductAdapter;
use App\Order\Infrastructure\Recommendation\RecommendationService;

class CreteOrderItemService
{
    public function __construct(
        private readonly ProductAdapter $productAdapter,
        private readonly RecommendationService $recommendationService,
        private readonly BasketAdapter $basketAdapter)
    {
    }

    /**
     * @return OrderItemDTORequest[]
     */
    public function createOrderItems(): array
    {
        if ('true' == $_ENV['MICRO']) {
            $basketData = $this->recommendationService->getRecommendationBasketData()->products;
        } else {
            $basketData = $this->basketAdapter->getBasketData();
        }

        $orderItemDTOs = [];
        foreach ($basketData as $basketItem) {
            if ('true' == $_ENV['MICRO']) {
                $productDto = $this->recommendationService->getRecommendationProductDataByUlid($basketItem->ulid);
            } else {
                $productData = $this->productAdapter->getProductDataByUlid($basketItem->getUlid());
                $productDto = $productData->productDTO;
            }
            $orderItemDTOs[] = new OrderItemDTORequest(
                productUlid: $basketItem->ulid,
                productCount: $basketItem->count,
                productName: $productDto->name,
                productPrice: $productDto->priceAfterDiscount,
                currency: $productDto->currency
            );
        }

        return $orderItemDTOs;
    }
}

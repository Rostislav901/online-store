<?php

namespace App\Basket\Infrastructure\Recommendation;

use App\Basket\Infrastructure\Recommendation\Model\RecommendationBasketProductResponse;
use App\Shared\Infrastructure\Recommendation\RecommendationService as AbstractRecommendationService;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class RecommendationService extends AbstractRecommendationService
{
    public function getRecommendationProductBasketDataByUlid(string $product_ulid): RecommendationBasketProductResponse
    {
        $response = $this->recommendationClient->request(
            'GET',
            '/api/v1/product-data-basket/by-ulid/*/recommendations'
        );

        return $this->serializer->deserialize(
            $response->getContent(),
            RecommendationBasketProductResponse::class,
            JsonEncoder::FORMAT
        );
    }
}

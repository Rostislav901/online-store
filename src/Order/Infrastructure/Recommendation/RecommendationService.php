<?php

namespace App\Order\Infrastructure\Recommendation;

use App\Order\Infrastructure\Recommendation\Model\RecommendationBasketDataResponse;
use App\Order\Infrastructure\Recommendation\Model\RecommendationProductDataResponse;
use App\Shared\Infrastructure\Recommendation\RecommendationService as AbstractRecommendationService;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class RecommendationService extends AbstractRecommendationService
{
    public function getRecommendationBasketData(): RecommendationBasketDataResponse
    {
        $response = $this->recommendationClient->request(
            'GET', '/api/v1/basket-data/recommendations'
        );

        return $this->serializer->deserialize(
            $response->getContent(),
            RecommendationBasketDataResponse::class,
            JsonEncoder::FORMAT
        );
    }

    public function getRecommendationProductDataByUlid(string $ulid): RecommendationProductDataResponse
    {
        $response = $this->recommendationClient->request(
            'GET', '/api/v1/product-data/by-ulid/'.$ulid.'/recommendations'
        );

        return $this->serializer->deserialize(
            $response->getContent(),
            RecommendationProductDataResponse::class,
            JsonEncoder::FORMAT
        );
    }
}

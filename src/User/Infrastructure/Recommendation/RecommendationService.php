<?php

namespace App\User\Infrastructure\Recommendation;

use App\Shared\Infrastructure\Recommendation\RecommendationService as AbstractRecommendationService;
use App\User\Infrastructure\Recommendation\Model\RecommendationProductCountResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class RecommendationService extends AbstractRecommendationService
{
    public function getRecommendationProductCountByUserUlid(string $user_ulid): RecommendationProductCountResponse
    {
        $response = $this->recommendationClient
            ->request('GET', '/api/v1/product-count/by-user-ulid/'.$user_ulid.'/recommendations');

        return $this->serializer->deserialize(
            $response->getContent(),
            RecommendationProductCountResponse::class,
            JsonEncoder::FORMAT);
    }
}

<?php

namespace App\ProductCatalog\Infrastructure\Recommendation;

use App\ProductCatalog\Infrastructure\Recommendation\Model\RecommendationUserDataResponse;
use App\ProductCatalog\Infrastructure\Recommendation\Model\RecommendationUserUlidResponse;
use App\Shared\Infrastructure\Recommendation\RecommendationService as AbstractRecommendationService;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class RecommendationService extends AbstractRecommendationService
{
    public function getRecommendationUserDataByUserUlid(string $user_ulid): RecommendationUserDataResponse
    {
        $response = $this->recommendationClient
            ->request('GET', '/api/v1/user-data/by-user-ulid/'.$user_ulid.'/recommendations');

        return $this->serializer->deserialize(
            $response->getContent(),
            RecommendationUserDataResponse::class,
            JsonEncoder::FORMAT);
    }

    public function getRecommendationUserUlidByUsername(string $username): RecommendationUserUlidResponse
    {
        $response = $this->recommendationClient
            ->request('GET', '/api/v1/user-ulid/by-username/'.$username.'recommendations');

        return $this->serializer->deserialize(
            $response->getContent(),
            RecommendationUserUlidResponse::class,
            JsonEncoder::FORMAT
        );
    }
}

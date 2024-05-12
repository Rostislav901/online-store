<?php

namespace App\ProductCatalog\Infrastructure\Recommendation\Model;

class RecommendationUserDataResponse
{
    public function __construct(
        public string $name,
        public int $registrationDate,
        public int $productCount)
    {
    }
}

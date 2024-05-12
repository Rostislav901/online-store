<?php

namespace App\Basket\Infrastructure\Recommendation\Model;

class RecommendationBasketProductResponse
{
    public function __construct(
        public string $ulid,
        public int $stock,
        public string $user_ulid)
    {
    }
}

<?php

namespace App\Order\Infrastructure\Recommendation\Model;

class RecommendationBasketDataResponse
{
    /**
     * @param RecommendationBasketItem[] $products
     */
    public function __construct(public array $products)
    {
    }
}

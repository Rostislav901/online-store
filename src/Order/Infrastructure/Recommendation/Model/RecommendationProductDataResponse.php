<?php

namespace App\Order\Infrastructure\Recommendation\Model;

class RecommendationProductDataResponse
{
    public function __construct(
        public string $name,
        public float $price,
        public float $priceAfterDiscount,
        public string $currency)
    {
    }
}

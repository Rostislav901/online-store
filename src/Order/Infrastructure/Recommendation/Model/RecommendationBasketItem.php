<?php

namespace App\Order\Infrastructure\Recommendation\Model;

class RecommendationBasketItem
{
    public function __construct(public string $ulid, public int $count)
    {
    }
}

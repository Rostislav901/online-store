<?php

namespace App\User\Infrastructure\Recommendation\Model;

class RecommendationProductCountResponse
{
    public function __construct(public int $count)
    {
    }
}

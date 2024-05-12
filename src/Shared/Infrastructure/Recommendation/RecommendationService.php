<?php

namespace App\Shared\Infrastructure\Recommendation;

use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class RecommendationService
{
    public function __construct(
        protected readonly HttpClientInterface $recommendationClient,
        protected readonly SerializerInterface $serializer)
    {
    }
}

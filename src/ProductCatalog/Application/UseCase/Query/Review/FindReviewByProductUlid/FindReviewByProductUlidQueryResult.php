<?php

namespace App\ProductCatalog\Application\UseCase\Query\Review\FindReviewByProductUlid;

use App\ProductCatalog\Application\DTO\Review\ReviewResponseDTO;

class FindReviewByProductUlidQueryResult
{
    /**
     * @param ReviewResponseDTO[] $reviews
     */
    public function __construct(public array $reviews)
    {
    }
}

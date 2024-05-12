<?php

namespace App\ProductCatalog\Application\Service;

use App\ProductCatalog\Application\DTO\Review\ReviewContainer;
use App\ProductCatalog\Application\DTO\Review\ReviewDTOTransformer;
use App\ProductCatalog\Domain\Repository\ReviewRepositoryInterface;

class ReviewService
{
    public function __construct(private readonly ReviewRepositoryInterface $reviewRepository,
        private readonly ReviewDTOTransformer $reviewDTOTransformer)
    {
    }

    public function getReviewDataByProductUlid(string $product_ulid): ReviewContainer
    {
        $reviews = $this->reviewRepository->findByProductUlid($product_ulid);
        $reviewsDto = $this->reviewDTOTransformer->fromEntityListToDTOList($reviews);

        return new ReviewContainer($reviewsDto);
    }
}

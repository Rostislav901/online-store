<?php

namespace App\ProductCatalog\Domain\Service;

use App\ProductCatalog\Domain\Factory\ReviewFactory;
use App\ProductCatalog\Domain\Repository\ProductRepositoryInterface;
use App\ProductCatalog\Domain\Repository\ReviewRepositoryInterface;

class ReviewMaker
{
    public function __construct(
        private readonly ReviewFactory $reviewFactory,
        private readonly ReviewRepositoryInterface $reviewRepository,
        private readonly ProductRepositoryInterface $productRepository)
    {
    }

    public function makeReview(
        string $text,
        int $rating, string $product_ulid): void
    {
        $this->productRepository->findOneByUlid($product_ulid);

        $review = $this->reviewFactory->create(
            text: $text,
            rating: $rating,
            product_ulid: $product_ulid
        );

        $this->reviewRepository->add($review);
    }
}

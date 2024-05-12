<?php

namespace App\ProductCatalog\Domain\Factory;

use App\ProductCatalog\Domain\Aggregate\Review\Entity\Review;
use App\ProductCatalog\Domain\Aggregate\Review\Specification\ReviewSpecification;
use App\Shared\Domain\Security\UserFetcherInterface;
use App\Shared\Domain\Specification\UlidSpecification;
use App\Shared\Domain\VO\ProductUlid;
use App\Shared\Domain\VO\UserUlid;

class ReviewFactory
{
    public function __construct(
        private readonly UserFetcherInterface $userFetcher,
        private readonly ReviewSpecification $reviewSpecification,
        private readonly UlidSpecification $ulidSpecification)
    {
    }

    public function create(string $text, int $rating, string $product_ulid): Review
    {
        return new Review(
            product_ulid: new ProductUlid($product_ulid, $this->ulidSpecification),
            user_ulid: new UserUlid($this->userFetcher->getUserAuth()->getUlid(), $this->ulidSpecification),
            text: $text,
            rating: $rating,
            specification: $this->reviewSpecification
        );
    }
}

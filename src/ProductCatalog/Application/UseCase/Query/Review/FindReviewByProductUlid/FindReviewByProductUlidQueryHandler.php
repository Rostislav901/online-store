<?php

namespace App\ProductCatalog\Application\UseCase\Query\Review\FindReviewByProductUlid;

use App\ProductCatalog\Application\DTO\Review\ReviewDTOTransformer;
use App\ProductCatalog\Application\Exception\ReviewNotFoundException;
use App\ProductCatalog\Domain\Repository\ProductRepositoryInterface;
use App\ProductCatalog\Domain\Repository\ReviewRepositoryInterface;
use App\Shared\Application\Query\QueryHandlerInterface;

class FindReviewByProductUlidQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly ReviewRepositoryInterface $reviewRepository,
        private readonly ProductRepositoryInterface $productRepository,
        private readonly ReviewDTOTransformer $reviewDTOTransformer)
    {
    }

    public function __invoke(FindReviewByProductUlidQuery $query): FindReviewByProductUlidQueryResult
    {
        $productUlid = $query->product_ulid;

        $this->productRepository->findOneByUlid($productUlid);

        $reviews = $this->reviewRepository->findByProductUlid($productUlid);

        if ([] == $reviews) {
            throw new ReviewNotFoundException();
        }

        $reviewsDto = $this->reviewDTOTransformer->fromEntityListToDTOList($reviews);

        return new FindReviewByProductUlidQueryResult($reviewsDto);
    }
}

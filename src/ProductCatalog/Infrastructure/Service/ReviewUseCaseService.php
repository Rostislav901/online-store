<?php

namespace App\ProductCatalog\Infrastructure\Service;

use App\ProductCatalog\Application\UseCase\Query\Review\FindReviewByProductUlid\FindReviewByProductUlidQuery;
use App\ProductCatalog\Application\UseCase\Query\Review\FindReviewByProductUlid\FindReviewByProductUlidQueryResult;
use App\ProductCatalog\Infrastructure\Adapter\User\UserAdapter;
use App\ProductCatalog\Infrastructure\Recommendation\RecommendationService;
use App\Shared\Application\Query\QueryBusInterface;

class ReviewUseCaseService
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
        private readonly RecommendationService $recommendationService,
        private readonly UserAdapter $userAdapter,
    ) {
    }

    public function findReview(string $productUlid): FindReviewByProductUlidQueryResult
    {
        $query = new FindReviewByProductUlidQuery($productUlid);

        /**
         * @var FindReviewByProductUlidQueryResult $res
         */
        $res = $this->queryBus->execute($query);

        foreach ($res->reviews as &$review) {
            if ('true' == $_ENV['MICRO']) {
                $review->setAuthor($this->userAdapter->getUserDataByUlid($review->getAuthor())->name);
            } else {
                $review->setAuthor($this->recommendationService->getRecommendationUserDataByUserUlid($review->getAuthor())->name);
            }
        }

        return $res;
    }
}

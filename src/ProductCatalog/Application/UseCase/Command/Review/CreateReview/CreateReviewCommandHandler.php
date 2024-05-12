<?php

namespace App\ProductCatalog\Application\UseCase\Command\Review\CreateReview;

use App\ProductCatalog\Domain\Service\ReviewMaker;
use App\Shared\Application\Command\CommandHandlerInterface;

class CreateReviewCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly ReviewMaker $reviewMaker
    ) {
    }

    public function __invoke(CreateReviewCommand $command): CreateReviewCommandResult
    {
        $reviewDto = $command->requestDTO;

        $this->reviewMaker->makeReview(
            text: $reviewDto->getText(),
            rating: $reviewDto->getRating(),
            product_ulid: $reviewDto->getProductUlid());

        return new CreateReviewCommandResult();
    }
}

<?php

namespace App\ProductCatalog\Application\UseCase\Command\Review\CreateReview;

use App\ProductCatalog\Application\DTO\Review\ReviewRequestDTO;
use App\Shared\Application\Command\CommandInterface;

class CreateReviewCommand implements CommandInterface
{
    public function __construct(public ReviewRequestDTO $requestDTO)
    {
    }
}

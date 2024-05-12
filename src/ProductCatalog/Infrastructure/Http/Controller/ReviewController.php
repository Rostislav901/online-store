<?php

namespace App\ProductCatalog\Infrastructure\Http\Controller;

use App\ProductCatalog\Application\DTO\Review\ReviewRequestDTO;
use App\ProductCatalog\Application\UseCase\Command\Review\CreateReview\CreateReviewCommand;
use App\ProductCatalog\Application\UseCase\Command\Review\CreateReview\CreateReviewCommandResult;
use App\ProductCatalog\Infrastructure\Service\ReviewUseCaseService;
use App\Shared\Application\Attribute\RequestBody;
use App\Shared\Application\Attribute\RequestParams;
use App\Shared\Application\DTO\ErrorResponse;
use App\Shared\Application\DTO\UlidDTO;
use App\Shared\Infrastructure\Bus\CommandBus;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ReviewController extends AbstractController
{
    public function __construct(
        private readonly CommandBus $commandBus,
        private readonly ReviewUseCaseService $reviewUseCaseService)
    {
    }

    #[OA\RequestBody(attachables: [new Model(type: ReviewRequestDTO::class)])]
    #[OA\Response(response: 400, description: 'Validation Error', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 404, description: 'Product not found', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 401, description: 'Authorization was failed. Check you token.', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 409, description: 'Target exception', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 200, description: 'Return success-message', attachables: [new Model(type: CreateReviewCommandResult::class)])]
    #[Route(path: '/api/v1/user/product/review/add', methods: ['POST'])]
    public function reviewAdd(#[RequestBody] ReviewRequestDTO $reviewDTO): Response
    {
        $command = new CreateReviewCommand($reviewDTO);
        /**
         * @var CreateReviewCommandResult $result
         */
        $result = $this->commandBus->execute($command);

        return $this->json($result);
    }

    #[OA\Response(response: 400, description: 'Validation Error', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 404, description: 'Product not found or review not found', attachables: [new Model(type: ErrorResponse::class)])]
    #[Route(path: '/api/v1/review/by/product/{ulid}', methods: ['GET'])]
    public function reviewsByProduct(#[RequestParams] UlidDTO $productUlid): Response
    {
        return $this->json($this->reviewUseCaseService->findReview($productUlid->ulid));
    }
}

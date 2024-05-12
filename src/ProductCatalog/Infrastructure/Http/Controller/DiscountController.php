<?php

namespace App\ProductCatalog\Infrastructure\Http\Controller;

use App\ProductCatalog\Application\DTO\Category\CategoryNameDTO;
use App\ProductCatalog\Application\DTO\Discount\DiscountDTO;
use App\ProductCatalog\Application\UseCase\Command\Discount\CreateDiscountOnCategory\CreateDiscountOnCategoryCommand;
use App\ProductCatalog\Application\UseCase\Command\Discount\CreateDiscountOnCategory\CreateDiscountOnCategoryCommandResult;
use App\ProductCatalog\Application\UseCase\Command\Discount\CreateDiscountOnProduct\CreateDiscountOnProductCommand;
use App\ProductCatalog\Application\UseCase\Command\Discount\CreateDiscountOnProduct\CreateDiscountOnProductCommandResult;
use App\Shared\Application\Attribute\RequestBody;
use App\Shared\Application\Attribute\RequestParams;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\DTO\ErrorResponse;
use App\Shared\Application\DTO\ProductNameDTO;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DiscountController extends AbstractController
{
    public function __construct(private readonly CommandBusInterface $commandBus)
    {
    }

    #[OA\Response(response: 200, description: 'Return success-message', attachables: [new Model(type: CreateDiscountOnProductCommandResult::class)])]
    #[OA\Response(response: 404, description: 'Product not found', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 400, description: 'Validation Error', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 401, description: 'Authorization was failed. Check you token.', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\RequestBody(attachables: [new Model(type: DiscountDTO::class)])]
    #[Route(path: '/api/v1/user/add/discount/on/product/{product_name}', methods: ['POST'])]
    public function addDiscountOnProduct(
        #[RequestParams] ProductNameDTO $productNameDTO,
        #[RequestBody] DiscountDTO $discountDTO): Response
    {
        $command = new CreateDiscountOnProductCommand($productNameDTO->getProductName(), $discountDTO);

        /**
         * @var CreateDiscountOnProductCommandResult $result
         */
        $result = $this->commandBus->execute($command);

        return $this->json($result);
    }

    #[OA\Response(response: 200, description: 'Add discount on all your products with pick category', attachables: [new Model(type: CreateDiscountOnCategoryCommandResult::class)])]
    #[OA\RequestBody(attachables: [new Model(type: DiscountDTO::class)])]
    #[OA\Response(response: 400, description: 'Validation Error', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 404, description: 'Product not found or category not found', attachables: [new Model(type: ErrorResponse::class)])]
    #[Route(path: '/api/v1/user/add/discount/on/category/{category}', methods: ['POST'])]
    public function addDiscountOnCategoryCommand(
        #[RequestParams] CategoryNameDTO $categoryNameDTO,
        #[RequestBody] DiscountDTO $discountDTO): Response
    {
        $command = new CreateDiscountOnCategoryCommand($categoryNameDTO->getCategory(), $discountDTO);

        /**
         * @var CreateDiscountOnCategoryCommandResult $result
         */
        $result = $this->commandBus->execute($command);

        return $this->json($result);
    }
}

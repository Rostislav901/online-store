<?php

namespace App\ProductCatalog\Infrastructure\Http\Controller;

use App\ProductCatalog\Application\DTO\Category\CategoryNameDTO;
use App\ProductCatalog\Application\DTO\Characteristic\CharacteristicsDTO;
use App\ProductCatalog\Application\DTO\Image\ImagesDTO;
use App\ProductCatalog\Application\DTO\Product\CombinedDTO;
use App\ProductCatalog\Application\DTO\Product\ProductDTO;
use App\ProductCatalog\Application\DTO\Product\ProductDTORequest;
use App\ProductCatalog\Application\DTO\Product\ProductSearchDTO;
use App\ProductCatalog\Application\UseCase\Command\Product\CreateProduct\CreateProductCommand;
use App\ProductCatalog\Application\UseCase\Command\Product\CreateProduct\CreateProductCommandResult;
use App\ProductCatalog\Application\UseCase\Query\Product\FindProductByCategory\FindProductByCategoryQuery;
use App\ProductCatalog\Application\UseCase\Query\Product\FindProductByCategory\FindProductByCategoryQueryResult;
use App\ProductCatalog\Application\UseCase\Query\Product\FindProductBySearch\FindProductBySearchQuery;
use App\ProductCatalog\Application\UseCase\Query\Product\FindProductBySearch\FindProductBySearchQueryResult;
use App\ProductCatalog\Application\UseCase\Query\Product\FindProductByUserUlid\FindProductByUserUlidQuery;
use App\ProductCatalog\Application\UseCase\Query\Product\FindProductByUserUlid\FindProductByUserUlidQueryReult;
use App\ProductCatalog\Application\UseCase\Query\Product\FindProductCountByCategory\FindProductCountByCategoryQuery;
use App\ProductCatalog\Application\UseCase\Query\Product\FindProductCountByCategory\FindProductCountByCategoryQueryResult;
use App\ProductCatalog\Infrastructure\Adapter\User\UserAdapter;
use App\ProductCatalog\Infrastructure\Recommendation\RecommendationService;
use App\ProductCatalog\Infrastructure\Service\ProductUseCaseService;
use App\Shared\Application\Attribute\RequestBody;
use App\Shared\Application\Attribute\RequestParams;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\DTO\ErrorResponse;
use App\Shared\Application\DTO\ProductNameDTO;
use App\Shared\Application\DTO\UlidDTO;
use App\Shared\Application\DTO\UserNameDTO;
use App\Shared\Application\Query\QueryBusInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    public function __construct(
        private readonly CommandBusInterface $commandBus,
        private readonly QueryBusInterface $queryBus,
        private readonly RecommendationService $recommendationService,
        private readonly ProductUseCaseService $productQueryService,
        private readonly UserAdapter $userAdapter)
    {
    }

    #[OA\Response(response: 404, description: 'Product not found', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 200, description: 'Return product by search', attachables: [new Model(type: FindProductBySearchQueryResult::class)])]
    #[OA\Response(response: 400, description: 'Validation Error', attachables: [new Model(type: ErrorResponse::class)])]
    #[Route(path: '/api/v1/store/products/by-search/{search}', name: 'products-search_route', methods: ['GET'])]
    public function productBySearch(#[RequestParams] ProductSearchDTO $productSearchDTO): Response
    {
        $query = new FindProductBySearchQuery($productSearchDTO->getSearch());

        /**
         * @var FindProductBySearchQueryResult $result
         */
        $result = $this->queryBus->execute($query);

        return $this->json($result);
    }

    #[OA\RequestBody(attachables: [new Model(type: CombinedDTO::class)])]
    #[OA\Response(response: 400, description: 'Validation Error', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 409, description: 'The product name must be unique within each user\'s account', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 404, description: 'Category not found', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 401, description: 'Authorization was failed. Check you token.', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 200, description: 'Return success-message', attachables: [new Model(type: CreateProductCommandResult::class)])]
    #[Route(path: '/api/v1/user/product/add', name: 'product-add_route', methods: ['POST'])]
    public function productAdd(
        #[RequestBody] ProductDTORequest $productDTO,
        #[RequestBody] CharacteristicsDTO $characteristicDTO,
        #[RequestBody] ImagesDTO $imageDTO): Response
    {
        $command = new CreateProductCommand($productDTO, $characteristicDTO, $imageDTO);

        /**
         * @var CreateProductCommandResult $result
         */
        $result = $this->commandBus->execute($command);

        return $this->json($result);
    }

    #[OA\Response(response: 200, description: 'Return products by category', attachables: [new Model(type: FindProductByCategoryQueryResult::class)])]
    #[OA\Response(response: 400, description: 'Validation Error', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 404, description: 'Category not found or Product not found', attachables: [new Model(type: ErrorResponse::class)])]
    #[Route(path: '/api/v1/category/{category}/product', name: 'product-by-category_route', methods: ['GET'])]
    public function getByCategory(#[RequestParams] CategoryNameDTO $categoryNameDTO): Response
    {
        $query = new FindProductByCategoryQuery($categoryNameDTO->getCategory());

        /**
         * @var FindProductByCategoryQueryResult $result
         */
        $result = $this->queryBus->execute($query);

        return $this->json($result);
    }

    #[OA\Response(response: 200, description: 'Return products by category', attachables: [new Model(type: FindProductCountByCategoryQueryResult::class)])]
    #[OA\Response(response: 400, description: 'Validation Error', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 404, description: 'Category not found', attachables: [new Model(type: ErrorResponse::class)])]
    #[Route(path: '/api/v1/category/{category}/product/count', name: 'product-count-by-category_route', methods: ['GET'])]
    public function getCountByCategory(#[RequestParams] CategoryNameDTO $categoryNameDTO): Response
    {
        $query = new FindProductCountByCategoryQuery($categoryNameDTO->getCategory());

        /**
         * @var FindProductCountByCategoryQueryResult $result
         */
        $result = $this->queryBus->execute($query);

        return $this->json($result);
    }

    #[OA\Response(response: 400, description: 'Validation Error', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 200, description: 'Return products by username', attachables: [new Model(type: FindProductByUserUlidQueryReult::class)])]
    #[OA\Response(response: 404, description: 'User not found or product not found', attachables: [new Model(type: ErrorResponse::class)])]
    #[Route(path: '/api/v1/products/by/{username}', name: 'product-by-username_route', methods: ['GET'])]
    public function getProductsByUsername(#[RequestParams] UserNameDTO $userNameDTO): Response
    {
        if ('true' == $_ENV['MICRO']) {
            $user_ulid = $this->recommendationService->getRecommendationUserUlidByUsername($userNameDTO->getUsername())->ulid;
        } else {
            $user_ulid = $this->userAdapter->getUserUlidByUsername($userNameDTO->getUsername());
        }
        $query = new FindProductByUserUlidQuery($user_ulid);
        /**
         * @var FindProductByUserUlidQueryReult $result
         */
        $result = $this->queryBus->execute($query);

        return $this->json($result);
    }

    #[OA\Response(response: 200, description: 'Return info about pick product', attachables: [new Model(type: ProductDTO::class)])]
    #[OA\Response(response: 400, description: 'Validation Error', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 404, description: 'Product not found', attachables: [new Model(type: ErrorResponse::class)])]
    #[Route(path: '/api/v1/product/find/product-by-ulid/{ulid}', name: 'product_route', methods: ['GET'])]
    public function productByUlid(#[RequestParams] UlidDTO $ulidDTO): Response
    {
        return $this->json($this->productQueryService->productByUlid($ulidDTO->ulid));
    }

    #[OA\Response(response: 400, description: 'Validation Error', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 200, description: 'Return info about pick product by user', attachables: [new Model(type: ProductDTO::class)])]
    #[OA\Response(response: 404, description: 'Product or User not found', attachables: [new Model(type: ErrorResponse::class)])]
    #[Route(path: '/api/v1/product/{product_name}/by/{username}', methods: ['GET'])]
    public function usersProductByName(
        #[RequestParams] ProductNameDTO $productNameDTO,
        #[RequestParams] UserNameDTO $userNameDTO,
    ): Response {
        return $this->json($this->productQueryService
            ->productByUsernameAndProductName($userNameDTO->getUsername(), $productNameDTO->productName));
    }
}

<?php

namespace App\ProductCatalog\Infrastructure\Http\Controller;

use App\ProductCatalog\Application\UseCase\Query\Category\FindAllCategory\FindAllCategoryQuery;
use App\ProductCatalog\Application\UseCase\Query\Category\FindAllCategory\FindAllCategoryQueryResult;
use App\Shared\Application\DTO\ErrorResponse;
use App\Shared\Infrastructure\Bus\QueryBus;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    public function __construct(private readonly QueryBus $queryBus)
    {
    }

    #[OA\Response(response: 404, description: 'Category not found', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 200, description: 'Return all categories', attachables: [new Model(type: FindAllCategoryQueryResult::class)])]
    #[Route(path: '/api/v1/categories', name: 'all-category_route', methods: ['GET'])]
    public function categories(): Response
    {
        $query = new FindAllCategoryQuery();

        /**
         * @var FindAllCategoryQueryResult $result
         */
        $result = $this->queryBus->execute($query);

        return $this->json($result);
    }
}

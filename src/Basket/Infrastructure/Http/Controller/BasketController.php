<?php

namespace App\Basket\Infrastructure\Http\Controller;

use App\Basket\Application\DTO\BasketProduct\BasketProductContainer;
use App\Basket\Application\UseCase\Command\CreateBasket\CreateBasketCommand;
use App\Basket\Application\UseCase\Command\CreateBasket\CreateBasketCommandResult;
use App\Basket\Application\UseCase\Query\FindBasket\FindBasketQuery;
use App\Basket\Application\UseCase\Query\FindBasket\FindBasketQueryResult;
use App\Basket\Infrastructure\Adapter\Product\ProductAdapter;
use App\Shared\Application\Attribute\RequestBody;
use App\Shared\Application\DTO\ErrorResponse;
use App\Shared\Infrastructure\Bus\CommandBus;
use App\Shared\Infrastructure\Bus\QueryBus;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BasketController extends AbstractController
{
    #[OA\Response(response: 200, description: 'Return success if product was added in to basket', attachables: [new Model(type: CreateBasketCommandResult::class)])]
    #[OA\Response(response: 400, description: 'Validation Error', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 401, description: 'Authorization was failed. Check you token.', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 404, description: 'Product not found', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 409, description: 'Product count error', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 410, description: 'Product target error', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\RequestBody(attachables: [new Model(type: BasketProductContainer::class)])]
    #[Route(path: '/api/v1/user/basket/create', methods: ['POST'])]
    public function basket(
        #[RequestBody] BasketProductContainer $container,
        ProductAdapter $adapter,
        CommandBus $commandBus): Response
    {
        $adapter->productsVerify($container->getProducts());

        $command = new CreateBasketCommand($container);
        /**
         * @var CreateBasketCommandResult $result
         */
        $result = $commandBus->execute($command);

        return $this->json($result);
    }

    #[OA\Response(response: 404, description: 'Basket empty', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 401, description: 'Authorization was failed. Check you token.', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 200, description: 'Return your product-bucket', attachables: [new Model(type: FindBasketQueryResult::class)])]
    #[Route(path: '/api/v1/user/basket/get', methods: ['GET'])]
    public function fromBasket(QueryBus $queryBus): Response
    {
        $query = new FindBasketQuery();
        /**
         * @var FindBasketQueryResult $result
         */
        $result = $queryBus->execute($query);

        return $this->json($result);
    }
}

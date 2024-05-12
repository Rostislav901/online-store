<?php

namespace App\Order\Infrastructure\Http\Controller;

use App\Order\Application\DTO\Order\OrderDTORequest;
use App\Order\Application\UseCase\Command\CreateOrder\CreateOrderCommand;
use App\Order\Application\UseCase\Command\CreateOrder\CreateOrderCommandResult;
use App\Order\Application\UseCase\Query\FindAllOrder\FindAllOrderQuery;
use App\Order\Application\UseCase\Query\FindAllOrder\FindAllOrderQueryResult;
use App\Order\Application\UseCase\Query\FindOrderByUlid\FindOrderByUlidQuery;
use App\Order\Application\UseCase\Query\FindOrderByUlid\FindOrderByUlidQueryResult;
use App\Order\Infrastructure\Service\CreteOrderItemService;
use App\Shared\Application\Attribute\RequestBody;
use App\Shared\Application\Attribute\RequestParams;
use App\Shared\Application\DTO\ErrorResponse;
use App\Shared\Application\DTO\UlidDTO;
use App\Shared\Application\Query\QueryBusInterface;
use App\Shared\Infrastructure\Bus\CommandBus;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OrderController extends AbstractController
{
    public function __construct(private readonly QueryBusInterface $queryBus)
    {
    }

    #[OA\Response(response: 200, description: 'Create new Order. Return Success', attachables: [new Model(type: CreateOrderCommandResult::class)])]
    #[OA\Response(response: 422, description: 'Error during conversion requestData', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 401, description: 'Authorization was failed. Check you token.', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 400, description: 'Validation Error', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\RequestBody(attachables: [new Model(type: OrderDTORequest::class)])]
    #[Route('/api/v1/user/order/make', methods: ['POST'])]
    public function order(
        #[RequestBody] OrderDTORequest $orderDTO,
        CreteOrderItemService $orderItemService,
        CommandBus $commandBus): Response
    {
        $command = new CreateOrderCommand($orderDTO, $orderItemService->createOrderItems());

        /**
         * @var CreateOrderCommandResult $result
         */
        $result = $commandBus->execute($command);

        return $this->json($result);
    }

    #[OA\Response(response: 401, description: 'Authorization was failed. Check you token.', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 404, description: 'Order not found', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 200, description: 'Return all your order', attachables: [new Model(type: FindAllOrderQueryResult::class)])]
    #[Route(path: '/api/v1/user/orders/all', methods: ['GET'])]
    public function getAllOrders(): Response
    {
        $query = new FindAllOrderQuery();
        /**
         * @var FindAllOrderQueryResult $result
         */
        $result = $this->queryBus->execute($query);

        return $this->json($result);
    }

    #[OA\Response(response: 401, description: 'Authorization was failed. Check you token.', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 404, description: 'Order not found', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 200, description: 'Return your order by ulid', attachables: [new Model(type: FindAllOrderQueryResult::class)])]
    #[OA\Response(response: 422, description: 'Error during conversion requestData', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 400, description: 'Validation Error', attachables: [new Model(type: ErrorResponse::class)])]
    #[Route(path: '/api/v1/user/order/{ulid}', methods: ['GET'])]
    public function getOrderByUlid(#[RequestParams] UlidDTO $ulidDTO): Response
    {
        $query = new FindOrderByUlidQuery($ulidDTO->ulid);

        /**
         * @var FindOrderByUlidQueryResult $result
         */
        $result = $this->queryBus->execute($query);

        return $this->json($result);
    }
}

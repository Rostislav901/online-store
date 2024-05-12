<?php

namespace App\Order\Application\UseCase\Query\FindOrderByUlid;

use App\Order\Application\DTO\Order\OrderDTOTransformer;
use App\Order\Domain\Repository\OrderRepositoryInterface;
use App\Shared\Application\Query\QueryHandlerInterface;
use App\Shared\Domain\Security\UserFetcherInterface;

class FindOrderByUlidQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly OrderRepositoryInterface $orderRepository,
        private readonly OrderDTOTransformer $transformer,
        private readonly UserFetcherInterface $userFetcher)
    {
    }

    public function __invoke(FindOrderByUlidQuery $query): FindOrderByUlidQueryResult
    {
        $order_ulid = $query->ulid;
        $order = $this->orderRepository->findOneOrderByUlid($order_ulid, $this->userFetcher->getUserAuth()->getUlid());

        $orderItemsEntity = $order->getOrderItems()->toArray();
        $orderItemsDTO = [];
        $totalCost = $order->getDeliveryCost();
        foreach ($orderItemsEntity as $item) {
            $item = $this->transformer->fromOrderItemEntityToDTO($item);
            $orderItemsDTO[] = $item;
            $totalCost += $item->totalCost;
        }

        return new FindOrderByUlidQueryResult(
            ulid: $order->getUlid(),
            status: $order->getStatus()->value,
            client: $order->getClientData()->getName(),
            deliveryAddress: $order->getDeliveryAddress(),
            deliveryType: $order->getDeliveryType()->value,
            deliveryCost: $order->getDeliveryCost(),
            paymentType: $order->getPaymentType()->value,
            items: $orderItemsDTO,
            orderCost: $totalCost
        );
    }
}

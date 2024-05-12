<?php

namespace App\Order\Domain\Service;

use App\Order\Domain\Aggregate\Order\Entity\Order;
use App\Order\Domain\Factory\OrderItemFactory;
use App\Order\Domain\Repository\OrderRepositoryInterface;
use App\Shared\Domain\Security\UserFetcherInterface;

class OrderItemMaker
{
    private Order $order;

    public function __construct(
        private readonly OrderItemFactory $orderItemFactory,
        private readonly UserFetcherInterface $userFetcher,
        private readonly OrderRepositoryInterface $orderRepository)
    {
    }

    public function makeOrderItemAndPersist(
        string $product_ulid,
        string $currency, string $productName,
        int $productCount, float $productPrice
    ): void {
        $orderItem = $this->orderItemFactory->create(
            order: $this->order,
            prudctUlid: $product_ulid,
            currency: $currency,
            productName: $productName,
            productCount: $productCount,
            productPrice: $productPrice
        );

        $this->orderRepository->getEntityManager()->persist($orderItem);
    }

    public function setOrder(string $order_ulid): void
    {
        $this->order = $this->orderRepository->
            findOneOrderByUlid(
                $order_ulid,
                $this->userFetcher->getUserAuth()->getUlid());
    }
}

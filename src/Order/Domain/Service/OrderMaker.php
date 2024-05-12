<?php

namespace App\Order\Domain\Service;

use App\Order\Domain\Factory\OrderFactory;
use App\Order\Domain\Repository\OrderRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class OrderMaker
{
    private readonly EntityManagerInterface $entityManager;

    public function __construct(private readonly OrderFactory $orderFactory,
        private readonly OrderRepositoryInterface $orderRepository)
    {
        $this->entityManager = $this->orderRepository->getEntityManager();
    }

    public function makeOrderAndPersist(
        string $status, string $deliveryAddress,
        string $deliveryType, float $deliveryCost,
        string $paymentType
    ): string {
        $order = $this->orderFactory->create(
            status: $status,
            deliveryAddress: $deliveryAddress,
            deliveryType: $deliveryType,
            deliveryCost: $deliveryCost,
            paymentType: $paymentType
        );
        $this->entityManager->persist($order);

        return $order->getUlid();
    }

    public function flush(): void
    {
        $this->entityManager->flush();
    }
}

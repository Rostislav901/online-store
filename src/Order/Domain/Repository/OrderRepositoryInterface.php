<?php

namespace App\Order\Domain\Repository;

use App\Order\Domain\Aggregate\Order\Entity\Order;

interface OrderRepositoryInterface
{
    /**
     * @return Order[]
     */
    public function findAllOrder(string $user_ulid): array;

    public function findOneOrderByUlid(string $ulid, string $user_ulid): Order;
}

<?php

namespace App\Order\Infrastructure\Repository;

use App\Order\Domain\Aggregate\Order\Entity\Order;
use App\Order\Domain\Repository\OrderItemRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class OrderItemRepository extends ServiceEntityRepository implements OrderItemRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }
}

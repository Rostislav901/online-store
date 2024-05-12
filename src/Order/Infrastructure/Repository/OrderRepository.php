<?php

namespace App\Order\Infrastructure\Repository;

use App\Order\Application\Exception\OrderNotFoundException;
use App\Order\Domain\Aggregate\Order\Entity\Order;
use App\Order\Domain\Repository\OrderRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class OrderRepository extends ServiceEntityRepository implements OrderRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function findAllOrder(string $user_ulid): array
    {
        $res = $this->findBy(['clientUlid.ulid' => $user_ulid]);

        return [] !== $res ? $res : throw new OrderNotFoundException();
    }

    public function findOneOrderByUlid(string $ulid, string $user_ulid): Order
    {
        $res = $this->findOneBy(['clientUlid.ulid' => $user_ulid, 'ulid' => $ulid]);

        return null !== $res ? $res : throw new OrderNotFoundException();
    }
}

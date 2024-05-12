<?php

namespace App\ProductCatalog\Infrastructure\Repository;

use App\ProductCatalog\Domain\Aggregate\Discount\Entity\Discount;
use App\ProductCatalog\Domain\Repository\DiscountRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DiscountRepository extends ServiceEntityRepository implements DiscountRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Discount::class);
    }

    public function findDiscountByUlid(string $ulid): ?Discount
    {
        return $this->findOneBy(['ulid' => $ulid]);
    }
}

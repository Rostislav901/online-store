<?php

namespace App\ProductCatalog\Infrastructure\Repository;

use App\ProductCatalog\Domain\Aggregate\Product\Entity\Characteristic;
use App\ProductCatalog\Domain\Repository\CharacteristicRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class CharacteristicRepository extends ServiceEntityRepository implements CharacteristicRepositoryInterface
{
    public function __construct(ManagerRegistry $registry, private EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Characteristic::class);
    }

    public function add(Characteristic $characteristic): void
    {
        $this->entityManager->persist($characteristic);
        $this->entityManager->flush();
    }
}

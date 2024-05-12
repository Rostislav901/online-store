<?php

namespace App\ProductCatalog\Infrastructure\Repository;

use App\ProductCatalog\Domain\Aggregate\Review\Entity\Review;
use App\ProductCatalog\Domain\Repository\ReviewRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class ReviewRepository extends ServiceEntityRepository implements ReviewRepositoryInterface
{
    public function __construct(ManagerRegistry $registry, private EntityManagerInterface $e_m)
    {
        parent::__construct($registry, Review::class);
    }

    public function findByProductUlid(string $product_ulid): array
    {
        return $this->findBy(['product_ulid.ulid' => $product_ulid]);
    }

    public function add(Review $review): void
    {
        $this->e_m->persist($review);
        $this->e_m->flush();
    }
}

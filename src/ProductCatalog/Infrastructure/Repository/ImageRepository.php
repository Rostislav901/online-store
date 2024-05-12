<?php

namespace App\ProductCatalog\Infrastructure\Repository;

use App\ProductCatalog\Domain\Aggregate\Product\Entity\Image;
use App\ProductCatalog\Domain\Repository\ImageRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ImageRepository extends ServiceEntityRepository implements ImageRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Image::class);
    }
}

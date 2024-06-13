<?php

namespace App\ProductCatalog\Infrastructure\Repository;

use App\ProductCatalog\Application\Exception\ProductNotFoundException;
use App\ProductCatalog\Domain\Aggregate\Product\Entity\Product;
use App\ProductCatalog\Domain\Repository\ProductRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class ProductRepository extends ServiceEntityRepository implements ProductRepositoryInterface
{
    public function __construct(ManagerRegistry $registry, private EntityManagerInterface $e_m)
    {
        parent::__construct($registry, Product::class);
    }

    public function addProduct(Product $product): void
    {
        $this->e_m->persist($product);
        $this->e_m->flush();
    }

    public function findOneByUlid(string $ulid): Product
    {
        $res = $this->findOneBy(['ulid' => $ulid]);

        return null !== $res ? $res : throw new ProductNotFoundException();
    }

    public function findByCategoryIdSortByCreatedAtDESC(int $categoryId): array
    {
        return $this->findBy(['category_id' => $categoryId], ['createdAt' => 'DESC']);
    }

    public function findCountByCategoryId(int $categoryId): int
    {
        return $this->count(['category_id' => $categoryId]);
    }

    public function findByUserUlid(string $user_ulid): array
    {
        $res = $this->findBy(['user_ulid.ulid' => $user_ulid], ['createdAt' => 'DESC']);

        return [] !== $res ? $res : throw new ProductNotFoundException();
    }

    public function findCountByUserUlid(string $user_ulid): int
    {
        return $this->count(['user_ulid.ulid' => $user_ulid]);
    }

    public function findProductBySearch(string $search): array
    {
        $res = $this->createQueryBuilder('product')
               ->where('product.name LIKE :search')
               ->setParameter('search', "%$search%")
               ->getQuery()
               ->getResult();

        return [] !== $res ? $res : throw new ProductNotFoundException();
    }

    public function existByNameAndUserUlid(string $name, string $user_ulid): bool
    {
        return null !== $this->findOneBy(['name' => $name, 'user_ulid.ulid' => $user_ulid]);
    }

//    public function findProductByName(string $name): Product
//    {
//        $res = $this->findOneBy(['name' => $name]);
//
//        return null !== $res ? $res : throw new ProductNotFoundException();
//    }

    public function getEM(): EntityManagerInterface
    {
        return $this->getEntityManager();
    }

    public function findOneProductByUserUlidAndProductName(string $user_ulid, string $productName): Product
    {
        $res = $this->findOneBy(['user_ulid.ulid' => $user_ulid, 'name' => $productName]);

        return null !== $res ? $res : throw new ProductNotFoundException();
    }

    public function existByUserUlidAndProductUlid(string $user_ulid, string $product_ulid): bool
    {
        return null !== $this->findOneBy(['ulid' => $product_ulid, 'user_ulid.ulid' => $user_ulid]);
    }

    public function findByCategoryAndUserUlid(int $categoryId, string $user_ulid): array
    {
        $res = $this->findBy(['category_id' => $categoryId, 'user_ulid.ulid' => $user_ulid]);

        return [] !== $res ? $res : throw new ProductNotFoundException();
    }
}

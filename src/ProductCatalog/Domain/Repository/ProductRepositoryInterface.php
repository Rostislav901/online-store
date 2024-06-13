<?php

namespace App\ProductCatalog\Domain\Repository;

use App\ProductCatalog\Domain\Aggregate\Product\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

interface ProductRepositoryInterface
{
    public function addProduct(Product $product): void;

    public function findOneByUlid(string $ulid): Product;

    /**
     * @return Product[]
     */
    public function findByCategoryIdSortByCreatedAtDESC(int $categoryId): array;

    public function findCountByCategoryId(int $categoryId): int;

    public function findCountByUserUlid(string $user_ulid): int;

    /**
     * @return Product[]
     */
    public function findByUserUlid(string $user_ulid): array;

    /**
     * @return Product[]
     */
    public function findProductBySearch(string $search): array;


    public function existByNameAndUserUlid(string $name, string $user_ulid): bool;

    public function existByUserUlidAndProductUlid(string $user_ulid, string $product_ulid): bool;

    public function getEM(): EntityManagerInterface;

    public function findOneProductByUserUlidAndProductName(string $user_ulid, string $productName): Product;

    /**
     * @return Product[]
     */
    public function findByCategoryAndUserUlid(int $categoryId, string $user_ulid): array;
}

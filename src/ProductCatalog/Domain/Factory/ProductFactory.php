<?php

namespace App\ProductCatalog\Domain\Factory;

use App\ProductCatalog\Domain\Aggregate\Product\Entity\Product;
use App\ProductCatalog\Domain\Aggregate\Product\Enum\Currency;
use App\ProductCatalog\Domain\Aggregate\Product\Specification\ProductSpecification;
use App\ProductCatalog\Domain\Repository\CategoryRepositoryInterface;
use App\Shared\Domain\Security\UserFetcherInterface;
use App\Shared\Domain\Specification\UlidSpecification;
use App\Shared\Domain\VO\UserUlid;

class ProductFactory
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly UlidSpecification $ulidSpecification,
        private readonly ProductSpecification $specification,
        private readonly UserFetcherInterface $fetcher)
    {
    }

    public function create(
        string $name, string $description, float $price,
        string $currency, string $categoryTitle,
        bool $isActive = true, ?int $stock = 1): Product
    {
        $category_id = $this->categoryRepository->getCategoryByTitle($categoryTitle)->getId();
        $user_ulid = $this->fetcher->getUserAuth()->getUlid();

        return new Product(
            name: $name,
            description: $description,
            price: $price,
            currency: Currency::from($currency),
            stock: $stock,
            isActive: $isActive,
            category_id: $category_id,
            user_ulid: new UserUlid($user_ulid, $this->ulidSpecification),
            specification: $this->specification
        );
    }
}

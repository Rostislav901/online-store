<?php

namespace App\ProductCatalog\Domain\Service;

use App\ProductCatalog\Domain\Factory\ProductFactory;
use App\ProductCatalog\Domain\Repository\ProductRepositoryInterface;

class ProductMaker
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly ProductFactory $productFactory,
    ) {
    }

    public function makeProduct(
        string $name, string $description,
        float $price, string $currency,
        string $categoryTitle, bool $isActive,
        int $stock
    ): string {
        $product = $this->productFactory->create(
            name: $name,
            description: $description,
            price: $price,
            currency: $currency,
            categoryTitle: $categoryTitle,
            isActive: $isActive,
            stock: $stock
        );

        $this->productRepository->addProduct($product);

        return $product->getName();
    }
}

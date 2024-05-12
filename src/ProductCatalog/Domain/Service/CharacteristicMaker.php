<?php

namespace App\ProductCatalog\Domain\Service;

use App\ProductCatalog\Domain\Aggregate\Product\Entity\Product;
use App\ProductCatalog\Domain\Factory\CharacteristicFactory;
use App\ProductCatalog\Domain\Repository\ProductRepositoryInterface;
use App\Shared\Domain\Security\UserFetcherInterface;
use Doctrine\ORM\EntityManagerInterface;

class CharacteristicMaker
{
    private readonly EntityManagerInterface $entityManager;
    private readonly Product $product;

    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly CharacteristicFactory $characteristicFactory,
        private readonly UserFetcherInterface $userFetcher)
    {
    }

    public function makeCharacteristicAndPersist(string $name, string $value): void
    {
        $image = $this->characteristicFactory->create(
            name: $name,
            value: $value,
            product: $this->product
        );
        $this->entityManager->persist($image);
    }

    public function flush(): void
    {
        $this->entityManager->flush();
    }

    public function setProduct(string $productName): void
    {
        $this->product = $this->productRepository->findOneProductByUserUlidAndProductName(
            user_ulid: $this->userFetcher->getUserAuth()->getUlid(),
            productName: $productName
        );

        $this->entityManager = $this->productRepository->getEM();
    }
}

<?php

namespace App\ProductCatalog\Domain\Service;

use App\ProductCatalog\Domain\Aggregate\Product\Entity\Product;
use App\ProductCatalog\Domain\Factory\ImageFactory;
use App\ProductCatalog\Domain\Repository\ProductRepositoryInterface;
use App\Shared\Domain\Security\UserFetcherInterface;
use Doctrine\ORM\EntityManagerInterface;

class ImageMaker
{
    private readonly EntityManagerInterface $entityManager;
    private readonly Product $product;

    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly ImageFactory $imageFactory,
        private readonly UserFetcherInterface $userFetcher)
    {
    }

    public function makeImageAndPersist(string $url, string $type): void
    {
        $image = $this->imageFactory->create(
            url: $url,
            type: $type,
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

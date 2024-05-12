<?php

namespace App\ProductCatalog\Domain\Service;

use App\ProductCatalog\Domain\Repository\ProductRepositoryInterface;
use App\ProductCatalog\Domain\VO\DiscountUlid;
use App\Shared\Domain\Security\UserFetcherInterface;
use App\Shared\Domain\Specification\UlidSpecification;

class ProductDiscountSetter
{
    private ?string $discount_ulid = null;

    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly UlidSpecification $ulidSpecification,
        private readonly UserFetcherInterface $userFetcher)
    {
    }

    public function setDiscountOnProduct(string $productName): void
    {
        $product = $this->productRepository
            ->findOneProductByUserUlidAndProductName(
                user_ulid: $this->userFetcher->getUserAuth()->getUlid(),
                productName: $productName
            );
        $product->setDiscountUlid(new DiscountUlid($this->discount_ulid, $this->ulidSpecification));

        $this->productRepository->getEM()->persist($product);
        $this->productRepository->getEM()->flush();
    }

    public function setDiscount(string $discount_ulid): void
    {
        $this->discount_ulid = $discount_ulid;
    }
}

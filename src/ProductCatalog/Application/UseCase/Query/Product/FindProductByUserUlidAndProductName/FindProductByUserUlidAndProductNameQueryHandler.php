<?php

namespace App\ProductCatalog\Application\UseCase\Query\Product\FindProductByUserUlidAndProductName;

use App\ProductCatalog\Application\Service\ProductService;
use App\ProductCatalog\Domain\Repository\ProductRepositoryInterface;
use App\Shared\Application\Query\QueryHandlerInterface;

class FindProductByUserUlidAndProductNameQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly ProductService $productService)
    {
    }

    public function __invoke(FindProductByUserUlidAndProductNameQuery $query): FindProductByUserUlidAndProductNameQueryResult
    {
        $user_ulid = $query->user_ulid;
        $productName = $query->productName;

        $product = $this->productRepository->findOneProductByUserUlidAndProductName($user_ulid, $productName);
        $productDto = $this->productService->productDTOByEntity($product);

        return new FindProductByUserUlidAndProductNameQueryResult($productDto);
    }
}

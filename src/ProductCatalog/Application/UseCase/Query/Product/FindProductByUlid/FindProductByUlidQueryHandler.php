<?php

namespace App\ProductCatalog\Application\UseCase\Query\Product\FindProductByUlid;

use App\ProductCatalog\Application\Service\ProductService;
use App\ProductCatalog\Domain\Repository\ProductRepositoryInterface;
use App\Shared\Application\Query\QueryHandlerInterface;

class FindProductByUlidQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly ProductService $productService)
    {
    }

    public function __invoke(FindProductByUlidQuery $query): FindProductByUlidQueryResult
    {
        $product = $this->productRepository->findOneByUlid($query->ulid);
        $dto = $this->productService->productDTOByEntity($product);

        return new FindProductByUlidQueryResult($dto, $product->getUserUlid()->getUlid());
    }
}

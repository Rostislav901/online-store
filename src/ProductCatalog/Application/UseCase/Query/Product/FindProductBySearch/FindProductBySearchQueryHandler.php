<?php

namespace App\ProductCatalog\Application\UseCase\Query\Product\FindProductBySearch;

use App\ProductCatalog\Application\DTO\Product\ProductDTOTransformer;
use App\ProductCatalog\Domain\Repository\ProductRepositoryInterface;
use App\Shared\Application\Query\QueryHandlerInterface;

class FindProductBySearchQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly ProductDTOTransformer $transformer)
    {
    }

    public function __invoke(FindProductBySearchQuery $query): FindProductBySearchQueryResult
    {
        $search = $query->search;

        $entityProducts = $this->productRepository->findProductBySearch($search);
        $dtoProducts = $this->transformer->fromProductEntityList($entityProducts);

        return new FindProductBySearchQueryResult($dtoProducts);
    }
}

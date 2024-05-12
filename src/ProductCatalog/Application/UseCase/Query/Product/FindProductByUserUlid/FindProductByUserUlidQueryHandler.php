<?php

namespace App\ProductCatalog\Application\UseCase\Query\Product\FindProductByUserUlid;

use App\ProductCatalog\Application\DTO\Product\ProductDTOTransformer;
use App\ProductCatalog\Domain\Repository\ProductRepositoryInterface;
use App\Shared\Application\Query\QueryHandlerInterface;

class FindProductByUserUlidQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly ProductRepositoryInterface $productRepository,
        private readonly ProductDTOTransformer $productDTOTransformer)
    {
    }

    public function __invoke(FindProductByUserUlidQuery $query): FindProductByUserUlidQueryReult
    {
        $user_ulid = $query->user_ulid;

        $products = $this->productRepository->findByUserUlid($user_ulid);

        $productsDTO = $this->productDTOTransformer->fromProductEntityList($products);

        return new FindProductByUserUlidQueryReult($productsDTO);
    }
}

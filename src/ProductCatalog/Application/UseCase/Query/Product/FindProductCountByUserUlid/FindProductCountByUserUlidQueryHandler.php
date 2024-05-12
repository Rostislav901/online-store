<?php

namespace App\ProductCatalog\Application\UseCase\Query\Product\FindProductCountByUserUlid;

use App\ProductCatalog\Domain\Repository\ProductRepositoryInterface;
use App\Shared\Application\Query\QueryHandlerInterface;

class FindProductCountByUserUlidQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly ProductRepositoryInterface $productRepository)
    {
    }

    public function __invoke(FindProductCountByUserUlidQuery $query): FindProductCountByUserUlidQueryResult
    {
        $user_ulid = $query->user_ulid;

        $productCount = $this->productRepository->findCountByUserUlid($user_ulid);

        return new FindProductCountByUserUlidQueryResult($productCount);
    }
}

<?php

namespace App\ProductCatalog\Application\UseCase\Query\Discount\FindDiscountByUlid;

use App\ProductCatalog\Application\DTO\Discount\DiscountDTOTransformer;
use App\ProductCatalog\Domain\Repository\DiscountRepositoryInterface;
use App\Shared\Application\Query\QueryHandlerInterface;

class FindDiscountByUlidQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly DiscountRepositoryInterface $discountRepository,
        private readonly DiscountDTOTransformer $discountDTOTransformer)
    {
    }

    public function __invoke(FindDiscountByUlidQuery $query): FindDiscountByUlidQueryResult
    {
        $ulid = $query->ulid;

        $discountEntity = $this->discountRepository->findDiscountByUlid($ulid);

        $discountDto = $this->discountDTOTransformer->fromEntityToDTO($discountEntity);

        return new FindDiscountByUlidQueryResult($discountDto);
    }
}

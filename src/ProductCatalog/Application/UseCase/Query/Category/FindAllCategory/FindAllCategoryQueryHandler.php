<?php

namespace App\ProductCatalog\Application\UseCase\Query\Category\FindAllCategory;

use App\ProductCatalog\Application\DTO\Category\CategoryDTOTransformer;
use App\ProductCatalog\Domain\Repository\CategoryRepositoryInterface;
use App\Shared\Application\Query\QueryHandlerInterface;

class FindAllCategoryQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly CategoryDTOTransformer $categoryDTOTransformer)
    {
    }

    public function __invoke(FindAllCategoryQuery $query): FindAllCategoryQueryResult
    {
        $categories = $this->categoryRepository->getAllCategories();

        $categories_DTO = $this->categoryDTOTransformer->fromCategoryEntityList($categories);

        return new FindAllCategoryQueryResult($categories_DTO);
    }
}

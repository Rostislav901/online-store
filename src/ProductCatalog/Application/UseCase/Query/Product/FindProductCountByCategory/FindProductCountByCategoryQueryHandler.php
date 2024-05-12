<?php

namespace App\ProductCatalog\Application\UseCase\Query\Product\FindProductCountByCategory;

use App\ProductCatalog\Domain\Aggregate\Category\Category;
use App\ProductCatalog\Domain\Repository\CategoryRepositoryInterface;
use App\ProductCatalog\Domain\Repository\ProductRepositoryInterface;
use App\Shared\Application\Query\QueryHandlerInterface;

class FindProductCountByCategoryQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly ProductRepositoryInterface $productRepository)
    {
    }

    public function __invoke(FindProductCountByCategoryQuery $query): FindProductCountByCategoryQueryResult
    {
        $category = $this->categoryRepository->getCategoryByTitle($query->getCategory());

        $productCount = $this->productRepository->findCountByCategoryId($category->getId());

        $children = $this->categoryRepository->getChildCategory($category);
        if (0 !== count($children)) {
            $productCount += $this->getProductCountByCategories($children);
        }

        return new FindProductCountByCategoryQueryResult($productCount);
    }

    public function getProductCountByCategories(array $categories): int
    {
        $count = 0;
        /**
         * @var Category[] $categories
         */
        foreach ($categories as $category) {
            $count += $this->productRepository->findCountByCategoryId($category->getId());

            $cs = $this->categoryRepository->getChildCategory($category);
            if (0 !== count($cs)) {
                $count += $this->getProductCountByCategories($cs);
            }
        }

        return $count;
    }
}

<?php

namespace App\ProductCatalog\Application\UseCase\Query\Product\FindProductByCategory;

use App\ProductCatalog\Application\DTO\Product\ProductDTOTransformer;
use App\ProductCatalog\Application\Exception\ProductNotFoundException;
use App\ProductCatalog\Domain\Aggregate\Category\Category;
use App\ProductCatalog\Domain\Aggregate\Product\Entity\Product;
use App\ProductCatalog\Domain\Repository\CategoryRepositoryInterface;
use App\ProductCatalog\Domain\Repository\ProductRepositoryInterface;
use App\Shared\Application\Query\QueryHandlerInterface;

class FindProductByCategoryQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly ProductDTOTransformer $productDTOTransformer,
        private readonly ProductRepositoryInterface $productRepository)
    {
    }

    public function __invoke(FindProductByCategoryQuery $query): FindProductByCategoryQueryResult
    {
        $category = $this->categoryRepository->getCategoryByTitle($query->getCategory());

        $products = $this->productRepository->findByCategoryIdSortByCreatedAtDESC($category->getId());

        $productsDTO = $this->productDTOTransformer->fromProductEntityList($products);

        $categoryChildren = $this->categoryRepository->getChildCategory($category);
        if (0 !== count($categoryChildren)) {
            $childrenProducts = $this->productDTOTransformer
                ->fromProductEntityList($this->getProductByCategories($categoryChildren));

            $productsDTO = array_merge($productsDTO, $childrenProducts);
        }
        if ([] === $productsDTO) {
            throw new ProductNotFoundException();
        }

        return new FindProductByCategoryQueryResult($productsDTO);
    }

    /**
     * @param Category[] $categories
     *
     * @return Product[]
     */
    public function getProductByCategories(array $categories): array
    {
        $products = [];

        foreach ($categories as $category) {
            $productsByCategory = $this->productRepository->findByCategoryIdSortByCreatedAtDESC($category->getId());

            $products = array_merge($products, $productsByCategory);

            $categoryChildren = $this->categoryRepository->getChildCategory($category);

            if (0 !== count($categoryChildren)) {
                $products = array_merge($products, $this->getProductByCategories($categoryChildren));
            }
        }

        return $products;
    }
}

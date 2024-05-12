<?php

namespace App\ProductCatalog\Domain\Repository;

use App\ProductCatalog\Domain\Aggregate\Category\Category;

interface CategoryRepositoryInterface
{
    public function getCategoryByTitle(string $categoryTitle): Category;

    /**
     * @return Category[]
     */
    public function getAllCategories(): array;

    /**
     * @return Category[]
     */
    public function getChildCategory(Category $category): array;

    public function getCategoryById(int $id): Category;
}

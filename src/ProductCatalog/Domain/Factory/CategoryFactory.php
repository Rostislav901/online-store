<?php

namespace App\ProductCatalog\Domain\Factory;

use App\ProductCatalog\Domain\Aggregate\Category\Category;

class CategoryFactory
{
    public function create(string $title, ?Category $parent): Category
    {
        $category = new Category();

        $category->setTitle($title);
        $category->setParent($parent);

        return $category;
    }
}

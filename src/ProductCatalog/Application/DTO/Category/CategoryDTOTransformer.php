<?php

namespace App\ProductCatalog\Application\DTO\Category;

use App\ProductCatalog\Domain\Aggregate\Category\Category;

class CategoryDTOTransformer
{
    /**
     * @param Category[] $categories_entity
     *
     * @return CategoryDTO[]
     */
    public function fromCategoryEntityList(array $categories_entity): array
    {
        $categoryDTOList = [];

        foreach ($categories_entity as $entity) {
            $categoryDTOList[] = $this->fromCategoryEntity($entity);
        }

        return $categoryDTOList;
    }

    public function fromCategoryEntity(Category $entity): CategoryDTO
    {
        return (new CategoryDTO())
                   ->setTitle($entity->getTitle())
                   ->setParentCategory($entity->getParent()?->getTitle());
    }
}

<?php

namespace App\ProductCatalog\Application\DTO\Category;

class CategoryContainerDTO
{
    private array $categories = [];

    /**
     * @return CategoryDTO[]
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    public function setCategories(array $categories): self
    {
        $this->categories = $categories;

        return $this;
    }
}

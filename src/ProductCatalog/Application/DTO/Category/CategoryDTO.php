<?php

namespace App\ProductCatalog\Application\DTO\Category;

class CategoryDTO
{
    private string $title;
    private ?string $parentCategory = null;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getParentCategory(): ?string
    {
        return $this->parentCategory;
    }

    public function setParentCategory(?string $parentCategory = null): self
    {
        $this->parentCategory = $parentCategory;

        return $this;
    }
}

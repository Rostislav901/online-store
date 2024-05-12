<?php

namespace App\ProductCatalog\Application\DTO\Category;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;

class CategoryNameDTO
{
    #[NotBlank]
    #[Type(type: 'string')]
    #[Length(min: 2, max: 40)]
    #[Regex(pattern: '/^[a-zA-Z-]{2,}$/')]
    public string $category;

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }
}

<?php

namespace App\ProductCatalog\Application\DTO\Product;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;

class ProductSearchDTO
{
    #[NotBlank]
    #[Length(max: 30)]
    #[Type(type: 'string')]
    #[Regex(pattern: '/^[a-zA-Z0-9-_ \s]{2,}$/')]
    public string $search;

    public function getSearch(): string
    {
        return $this->search;
    }

    public function setSearch(string $search): self
    {
        $this->search = $search;

        return $this;
    }
}

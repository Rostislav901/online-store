<?php

namespace App\Shared\Application\DTO;

use Symfony\Component\Serializer\Attribute\SerializedName;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class ProductNameDTO
{
    #[NotBlank]
    #[Length(min: 3, max: 30)]
    #[Regex(pattern: '/^[a-zA-Z0-9-_ \s]{2,}$/')]
    #[SerializedName('product_name')]
    public string $productName;

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

        return $this;
    }
}

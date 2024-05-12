<?php

namespace App\Basket\Application\DTO\BasketProduct;

use Symfony\Component\Serializer\Attribute\SerializedName;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Valid;

class BasketProductContainer
{
    public function __construct(
        /**
         * @var BasketProductDTO[]
         */
        #[SerializedName('products')]
        #[NotBlank]
        #[Type(type: 'array')]
        #[Valid]
        private readonly array $products)
    {
    }

    public function getProducts(): array
    {
        return $this->products;
    }
}

<?php

namespace App\ProductCatalog\Domain\Factory;

use App\ProductCatalog\Domain\Aggregate\Product\Entity\Characteristic;
use App\ProductCatalog\Domain\Aggregate\Product\Entity\Product;

class CharacteristicFactory
{
    public function __construct()
    {
    }

    public function create(string $name, string $value, Product $product): Characteristic
    {
        return new Characteristic(
            name: $name,
            value: $value,
            product: $product
        );
    }
}

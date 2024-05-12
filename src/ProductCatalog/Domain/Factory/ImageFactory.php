<?php

namespace App\ProductCatalog\Domain\Factory;

use App\ProductCatalog\Domain\Aggregate\Product\Entity\Image;
use App\ProductCatalog\Domain\Aggregate\Product\Entity\Product;

class ImageFactory
{
    public function __construct()
    {
    }

    public function create(string $url, string $type, Product $product): Image
    {
        return new Image(
            url: $url,
            product: $product,
            type: $type
        );
    }
}

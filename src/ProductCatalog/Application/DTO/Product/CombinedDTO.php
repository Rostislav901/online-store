<?php

namespace App\ProductCatalog\Application\DTO\Product;

use App\ProductCatalog\Application\DTO\Characteristic\CharacteristicItemDTO;
use App\ProductCatalog\Application\DTO\Image\ImageItemDTO;

class CombinedDTO
{
    public string $name;
    public string $description;
    public float $price;
    public string $currency;
    public string $category;
    /**
     * @var CharacteristicItemDTO[]
     */
    public array $characteristic;
    /**
     * @var ImageItemDTO[]
     */
    public array $images;
}

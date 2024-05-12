<?php

namespace App\ProductCatalog\Application\UseCase\Command\Product\CreateProduct;

use App\ProductCatalog\Application\DTO\Characteristic\CharacteristicsDTO;
use App\ProductCatalog\Application\DTO\Image\ImagesDTO;
use App\ProductCatalog\Application\DTO\Product\ProductDTORequest;
use App\Shared\Application\Command\CommandInterface;

class CreateProductCommand implements CommandInterface
{
    public function __construct(
        public readonly ProductDTORequest $productDTO,
        public readonly CharacteristicsDTO $characteristicsDTO,
        public readonly ImagesDTO $imagesDTO)
    {
    }
}

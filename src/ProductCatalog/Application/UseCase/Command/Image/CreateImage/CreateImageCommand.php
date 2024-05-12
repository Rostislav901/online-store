<?php

namespace App\ProductCatalog\Application\UseCase\Command\Image\CreateImage;

use App\ProductCatalog\Application\DTO\Image\ImagesDTO;
use App\Shared\Application\Command\CommandInterface;

class CreateImageCommand implements CommandInterface
{
    public function __construct(
        public readonly ImagesDTO $imageDTO,
        public readonly string $productName)
    {
    }
}

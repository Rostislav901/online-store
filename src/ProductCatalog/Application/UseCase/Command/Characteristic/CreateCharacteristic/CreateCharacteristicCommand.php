<?php

namespace App\ProductCatalog\Application\UseCase\Command\Characteristic\CreateCharacteristic;

use App\ProductCatalog\Application\DTO\Characteristic\CharacteristicsDTO;
use App\Shared\Application\Command\CommandInterface;

class CreateCharacteristicCommand implements CommandInterface
{
    public function __construct(
        public readonly CharacteristicsDTO $characteristicDTO,
        public readonly string $productName)
    {
    }
}

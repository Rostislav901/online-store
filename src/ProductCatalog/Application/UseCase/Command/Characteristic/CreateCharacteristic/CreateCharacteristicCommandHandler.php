<?php

namespace App\ProductCatalog\Application\UseCase\Command\Characteristic\CreateCharacteristic;

use App\ProductCatalog\Domain\Service\CharacteristicMaker;
use App\Shared\Application\Command\CommandHandlerInterface;

class CreateCharacteristicCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly CharacteristicMaker $characteristicMaker
    ) {
    }

    public function __invoke(CreateCharacteristicCommand $command): CreateCharacteristicCommandResult
    {
        $dto = $command->characteristicDTO->getCharacteristic();
        $productName = $command->productName;

        $this->characteristicMaker->setProduct($productName);

        foreach ($dto as $characteristicItemDTO) {
            $this->characteristicMaker->makeCharacteristicAndPersist(
                name: $characteristicItemDTO->getName(),
                value: $characteristicItemDTO->getValue()
            );
        }
        $this->characteristicMaker->flush();

        return new CreateCharacteristicCommandResult();
    }
}

<?php

namespace App\ProductCatalog\Application\UseCase\Command\Product\CreateProduct;

use App\ProductCatalog\Application\UseCase\Command\Characteristic\CreateCharacteristic\CreateCharacteristicCommand;
use App\ProductCatalog\Application\UseCase\Command\Image\CreateImage\CreateImageCommand;
use App\ProductCatalog\Domain\Service\ProductMaker;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Command\CommandHandlerInterface;

class CreateProductCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly ProductMaker $productMaker,
        private readonly CommandBusInterface $commandBus)
    {
    }

    public function __invoke(CreateProductCommand $command): CreateProductCommandResult
    {
        $productData = $command->productDTO;
        $productName = $this->productMaker->makeProduct(
            name: $productData->getName(),
            description: $productData->getDescription(),
            price: $productData->getPrice(),
            currency: $productData->getCurrency(),
            categoryTitle: $productData->getCategory(),
            isActive: $productData->isActive(),
            stock: $productData->getStock()
        );

        $createCharacteristicCommand = new CreateCharacteristicCommand($command->characteristicsDTO, $productName);
        $createImageCommand = new CreateImageCommand($command->imagesDTO, $productName);

        $this->commandBus->execute($createCharacteristicCommand);
        $this->commandBus->execute($createImageCommand);

        return new CreateProductCommandResult();
    }
}

<?php

namespace App\ProductCatalog\Application\UseCase\Command\Image\CreateImage;

use App\ProductCatalog\Domain\Service\ImageMaker;
use App\Shared\Application\Command\CommandHandlerInterface;

class CreateImageCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly ImageMaker $imageMaker)
    {
    }

    public function __invoke(CreateImageCommand $command): CreateImageCommandResult
    {
        $dto = $command->imageDTO->getImages();
        $productName = $command->productName;

        $this->imageMaker->setProduct($productName);

        foreach ($dto as $imageItemDTO) {
            $this->imageMaker->makeImageAndPersist(
                url: $imageItemDTO->getUrl(),
                type: $imageItemDTO->getType(),
            );
        }
        $this->imageMaker->flush();

        return new CreateImageCommandResult();
    }
}

<?php

namespace App\ProductCatalog\Application\DTO\Image;

use App\ProductCatalog\Domain\Aggregate\Product\Entity\Image;

class ImageDTOTransformer
{
    /**
     * @param Image[] $entityList
     *
     * @return ImageItemDTO[]
     */
    public function fromEntityListToDTOItemList(array $entityList): array
    {
        $res = [];
        foreach ($entityList as $image) {
            $res[] = $this->fromEntityToDTOItem($image);
        }

        return $res;
    }

    public function fromEntityToDTOItem(Image $entity): ImageItemDTO
    {
        return (new ImageItemDTO())
            ->setType($entity->getType())
            ->setUrl($entity->getUrl());
    }
}

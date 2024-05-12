<?php

namespace App\ProductCatalog\Application\DTO\Characteristic;

use App\ProductCatalog\Domain\Aggregate\Product\Entity\Characteristic;

class CharacteristicDTOTransformer
{
    /**
     * @param Characteristic[] $entityList
     *
     * @return CharacteristicItemDTO[]
     */
    public function fromEntityListToDTOItemList(array $entityList): array
    {
        $res = [];
        foreach ($entityList as $characteristic) {
            $res[] = $this->fromEntityToDTOItem($characteristic);
        }

        return $res;
    }

    public function fromEntityToDTOItem(Characteristic $entity): CharacteristicItemDTO
    {
        return (new CharacteristicItemDTO())
                       ->setName($entity->getName())
                       ->setValue($entity->getValue());
    }
}

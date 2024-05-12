<?php

namespace App\ProductCatalog\Application\DTO\Characteristic;

use OpenApi\Attributes as OA;
use Symfony\Component\Serializer\Attribute\SerializedName;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Valid;

class CharacteristicsDTO
{
    /**
     * @var CharacteristicItemDTO[]
     */
    #[SerializedName('characteristic')]
    #[NotBlank]
    #[Type(type: 'array')]
    #[All([new Type(type: CharacteristicItemDTO::class)])]
    #[OA\Property(type: 'array', items: new OA\Items(ref: CharacteristicItemDTO::class))]
    #[Valid]
    private array $characteristic;

    /**
     * @return CharacteristicItemDTO[]
     */
    public function getCharacteristic(): array
    {
        return $this->characteristic;
    }

    public function setCharacteristic(array $characteristic): self
    {
        $this->characteristic = $characteristic;

        return $this;
    }
}

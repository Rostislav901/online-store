<?php

namespace App\ProductCatalog\Application\DTO\Image;

use Symfony\Component\Serializer\Attribute\SerializedName;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Valid;

class ImagesDTO
{
    /**
     * @var ImageItemDTO[]
     */
    #[SerializedName('images')]
    #[NotBlank]
    #[Type(type: 'array')]
    #[Valid]
    private array $images = [];

    public function getImages(): array
    {
        return $this->images;
    }

    public function setImages(array $images): self
    {
        $this->images = $images;

        return $this;
    }
}

<?php

namespace App\ProductCatalog\Application\DTO\Image;

use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class ImageItemDTO
{
    #[NotBlank]
    #[Length(min: 5, max: 50)]
    #[Type(type: 'string')]
    private string $url;

    #[NotBlank]
    #[Type(type: 'string')]
    #[Choice(choices: ['additional', 'main'])]
    private string $type;

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = null === $type ? $this->type : $type;

        return $this;
    }
}

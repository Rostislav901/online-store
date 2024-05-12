<?php

namespace App\ProductCatalog\Application\DTO\Characteristic;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class CharacteristicItemDTO
{
    #[NotBlank]
    #[Length(max: 15)]
    private string $name;
    #[NotBlank]
    #[Length(max: 50)]
    private string $value;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }
}

<?php

namespace App\Basket\Application\DTO\BasketProduct;

use Symfony\Component\Serializer\Attribute\SerializedName;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Ulid;

class BasketProductDTO
{
    public function __construct(
        #[SerializedName('ulid')]
        #[Ulid]
        public string $ulid,
        #[SerializedName('count')]
        #[NotBlank]
        #[Type(type: 'int')]
        public int $count)
    {
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function setUlid(string $ulid): self
    {
        $this->ulid = $ulid;

        return $this;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }

    public function getCount(): int
    {
        return $this->count;
    }
}

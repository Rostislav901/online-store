<?php

namespace App\ProductCatalog\Application\DTO\Review;

use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Ulid;

class ReviewRequestDTO
{
    public function __construct(
        #[NotBlank]
        #[Type(type: 'string')]
        #[Length(min: 1, max: 75)]
        private readonly string $text,
        #[NotBlank]
        #[Type(type: 'int')]
        #[Choice(choices: [1, 2, 3, 4, 5])]
        private readonly int $rating,
        #[Ulid]
        private readonly string $product_ulid,
    ) {
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function getProductUlid(): string
    {
        return $this->product_ulid;
    }
}

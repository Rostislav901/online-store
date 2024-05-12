<?php

namespace App\ProductCatalog\Application\DTO\Review;

class ReviewResponseDTO
{
    public function __construct(
        private string $text,
        private float $rating,
        private string $author,
        private int $dateCreated)
    {
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getRating(): float
    {
        return $this->rating;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getDateCreated(): int
    {
        return $this->dateCreated;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function setRating(float $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function setDateCreated(int $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }
}

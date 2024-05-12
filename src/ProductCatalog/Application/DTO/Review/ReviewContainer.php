<?php

namespace App\ProductCatalog\Application\DTO\Review;

class ReviewContainer
{
    /**
     * @param ReviewResponseDTO[] $reviews
     */
    public function __construct(private readonly array $reviews = [])
    {
    }

    private function reviewsEmpty(): bool
    {
        return [] === $this->reviews;
    }

    public function getAverageRating(): ?float
    {
        if (!$this->reviewsEmpty()) {
            $sum = array_sum(array_map(fn ($item) => $item->getRating(), $this->reviews));

            return round($sum / count($this->reviews), 1);
        }

        return null;
    }

    public function getCount(): int
    {
        return count($this->reviews);
    }
}

<?php

namespace App\ProductCatalog\Application\DTO\Product;

class ProductItemDTO
{
    private string $ulid;
    private string $name;
    private int $price;
    private ?float $discount;
    private int $priceAfterDiscount;
    private ?float $rating;
    private int $reviewCount;
    private bool $isActive;
    private string $currency;

    public function __construct(
        string $name, int $price, ?float $discount,
        int $priceAfterDiscount, ?float $rating,
        int $reviewCount, bool $isActive,
        string $ulid, string $currency)
    {
        $this->ulid = $ulid;
        $this->name = $name;
        $this->price = $price;
        $this->discount = $discount;
        $this->priceAfterDiscount = $priceAfterDiscount;
        $this->rating = $rating;
        $this->reviewCount = $reviewCount;
        $this->isActive = $isActive;
        $this->currency = $currency;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function getPriceAfterDiscount(): int
    {
        return $this->priceAfterDiscount;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function getReviewCount(): int
    {
        return $this->reviewCount;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}

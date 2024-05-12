<?php

namespace App\ProductCatalog\Application\DTO\Product;

class ProductDTO
{
    public string $name;
    public string $salesperson;
    public float $price;
    public float $discount;
    public ?int $discountDateStart;
    public ?int $discountDateEnd;
    public float $priceAfterDiscount;
    public string $currency;
    public string $dateCreate;
    public bool $isActive;
    public int $stock;
    public int $reviewCount;
    public ?float $rating;
    public array $characteristics;

    public array $images;
    public string $category;

    public function __construct(
        string $name, float $price, float $discount,
        ?int $discountDateStart, ?int $discountDateEnd, float $priceAfterDiscount,
        string $currency, string $dateCreate, bool $isActive, int $stock,
        string $category, int $reviewCount, ?float $rating, array $characteristics, array $images)
    {
        $this->name = $name;
        $this->price = $price;
        $this->discount = $discount;
        $this->discountDateStart = $discountDateStart;
        $this->discountDateEnd = $discountDateEnd;
        $this->priceAfterDiscount = $priceAfterDiscount;
        $this->currency = $currency;
        $this->dateCreate = $dateCreate;
        $this->isActive = $isActive;
        $this->stock = $stock;
        $this->category = $category;
        $this->reviewCount = $reviewCount;
        $this->rating = $rating;
        $this->characteristics = $characteristics;
        $this->images = $images;
    }
}

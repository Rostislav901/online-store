<?php

namespace App\ProductCatalog\Application\DTO\Product;

use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class ProductDTORequest
{
    #[NotBlank]
    #[Length(max: 30)]
    private string $name;
    #[NotBlank]
    #[Length(max: 150)]
    private string $description;
    #[NotBlank]
    private float $price;
    #[NotBlank]
    #[Length(exactly: 3)]
    #[Choice(choices: ['USD', 'EUR', 'GBP', 'UAH', 'CNY'])]
    private string $currency;
    #[NotBlank]
    #[Length(min: 2, max: 15)]
    private string $category;
    #[NotBlank]
    #[Choice(choices: [true, false])]
    private bool $isActive;
    #[NotBlank]
    #[Type(type: 'int')]
    private int $stock;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }
}

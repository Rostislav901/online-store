<?php

namespace App\Order\Application\DTO\Order;

class OrderItemDTORequest
{
    private string $productUlid;
    private int $productCount;
    private float $productPrice;
    private string $currency;
    private string $productName;

    public function __construct(
        string $productUlid, int $productCount, string $productName,
        float $productPrice, $currency)
    {
        $this->productUlid = $productUlid;
        $this->productCount = $productCount;
        $this->productPrice = $productPrice;
        $this->currency = $currency;
        $this->productName = $productName;
    }

    public function getProductUlid(): string
    {
        return $this->productUlid;
    }

    public function setProductUlid(string $productUlid): self
    {
        $this->productUlid = $productUlid;

        return $this;
    }

    public function getProductCount(): int
    {
        return $this->productCount;
    }

    public function setProductCount(int $productCount): self
    {
        $this->productCount = $productCount;

        return $this;
    }

    public function getProductPrice(): float
    {
        return $this->productPrice;
    }

    public function setProductPrice(float $productPrice): self
    {
        $this->productPrice = $productPrice;

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

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

        return $this;
    }
}

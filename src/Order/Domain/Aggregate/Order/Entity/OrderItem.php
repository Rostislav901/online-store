<?php

namespace App\Order\Domain\Aggregate\Order\Entity;

use App\Shared\Domain\Service\UlidGenerator;
use App\Shared\Domain\VO\ProductUlid;

class OrderItem
{
    private readonly string $ulid;
    private Order $order;

    private float $totalCost;

    private readonly ProductUlid $product_ulid;
    private string $productName;
    private int $productCount;
    private float $productPrice;
    private string $currency;

    public function __construct(
        Order $order, ProductUlid $product_ulid,
        $currency, $productName,
        int $productCount, float $productPrice)
    {
        $this->ulid = UlidGenerator::generate();
        $this->order = $order;
        $this->product_ulid = $product_ulid;
        $this->productCount = $productCount;
        $this->productName = $productName;
        $this->productPrice = $productPrice;
        $this->currency = $currency;
        $this->totalCost = $productPrice * $productCount;
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function getTotalCost(): float
    {
        return $this->totalCost;
    }

    public function getProductCount(): int
    {
        return $this->productCount;
    }

    public function getProductPrice(): float
    {
        return $this->productPrice;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getProductUlid(): ProductUlid
    {
        return $this->product_ulid;
    }

    public function setOrder(Order $order): self
    {
        $this->order = $order;

        return $this;
    }

    public function setTotalCost(float $totalCost): self
    {
        $this->totalCost = $totalCost;

        return $this;
    }

    public function setProductCount(int $productCount): self
    {
        $this->productCount = $productCount;

        return $this;
    }

    public function setProductPrice(float $productPrice): self
    {
        $this->productPrice = $productPrice;

        return $this;
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

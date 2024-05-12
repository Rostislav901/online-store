<?php

namespace App\Order\Application\DTO\Order;

class OrderItemDTOResponse
{
    public function __construct(
        public string $product_ulid,
        public int $productCount,
        public float $productPrice,
        public string $currency,
        public string $productName,
        public float $totalCost)
    {
    }
}

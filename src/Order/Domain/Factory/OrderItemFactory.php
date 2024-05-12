<?php

namespace App\Order\Domain\Factory;

use App\Order\Domain\Aggregate\Order\Entity\Order;
use App\Order\Domain\Aggregate\Order\Entity\OrderItem;
use App\Shared\Domain\Specification\UlidSpecification;
use App\Shared\Domain\VO\ProductUlid;

class OrderItemFactory
{
    public function __construct(private readonly UlidSpecification $ulidSpecification)
    {
    }

    public function create(
        Order $order, string $prudctUlid,
        string $currency, string $productName,
        int $productCount, float $productPrice): OrderItem
    {
        return new OrderItem(
            order: $order,
            product_ulid: new ProductUlid($prudctUlid, $this->ulidSpecification),
            currency: $currency,
            productName: $productName,
            productCount: $productCount,
            productPrice: $productPrice
        );
    }
}

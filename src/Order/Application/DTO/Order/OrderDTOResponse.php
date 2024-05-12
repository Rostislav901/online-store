<?php

namespace App\Order\Application\DTO\Order;

class OrderDTOResponse
{
    public function __construct(
        public string $order_ulid,
        public string $status,
        public int $productCount,
        /**
         * @var string[] $products // names
         */
        public array $products)
    {
    }
}

<?php

namespace App\Order\Application\UseCase\Query\FindOrderByUlid;

class FindOrderByUlidQueryResult
{
    public function __construct(
        public string $ulid, public string $status,
        public string $client, public string $deliveryAddress,
        public string $deliveryType, public float $deliveryCost,
        public string $paymentType, public array $items, public float $orderCost)
    {
    }
}

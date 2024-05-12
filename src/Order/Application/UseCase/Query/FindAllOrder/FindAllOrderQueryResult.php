<?php

namespace App\Order\Application\UseCase\Query\FindAllOrder;

use App\Order\Application\DTO\Order\OrderDTOResponse;

class FindAllOrderQueryResult
{
    /**
     * @param OrderDTOResponse[] $orders
     */
    public function __construct(public array $orders)
    {
    }
}

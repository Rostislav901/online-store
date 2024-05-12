<?php

namespace App\Order\Application\UseCase\Command\CreateOrder;

use App\Order\Application\DTO\Order\OrderDTORequest;
use App\Order\Application\DTO\Order\OrderItemDTORequest;
use App\Shared\Application\Command\CommandInterface;

class CreateOrderCommand implements CommandInterface
{
    public function __construct(
        public readonly OrderDTORequest $orderDTO,
        /**
         * @var OrderItemDTORequest[] $orderItemsDTO
         */
        public array $orderItemsDTO)
    {
    }
}

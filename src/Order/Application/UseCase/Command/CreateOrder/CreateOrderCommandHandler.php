<?php

namespace App\Order\Application\UseCase\Command\CreateOrder;

use App\Order\Application\DTO\Order\OrderItemDTORequest;
use App\Order\Domain\Service\OrderItemMaker;
use App\Order\Domain\Service\OrderMaker;
use App\Shared\Application\Command\CommandHandlerInterface;

class CreateOrderCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly OrderMaker $orderMaker,
        private readonly OrderItemMaker $orderItemMaker
    ) {
    }

    public function __invoke(CreateOrderCommand $command): CreateOrderCommandResult
    {
        $orderDTO = $command->orderDTO;

        $orderDTOItems = $command->orderItemsDTO;

        $order_ulid = $this->orderMaker->makeOrderAndPersist(
            status: $orderDTO->getStatus(),
            deliveryAddress: $orderDTO->getDeliveryAddress(),
            deliveryType: $orderDTO->getDeliveryType(),
            deliveryCost: $orderDTO->getDeliveryCost(),
            paymentType: $orderDTO->getPaymentType()
        );
        $this->orderMaker->flush();
        $this->orderItemMaker->setOrder($order_ulid);
        /**
         * @var OrderItemDTORequest $orderItemDTO
         */
        foreach ($orderDTOItems as $orderItemDTO) {
            $this->orderItemMaker->makeOrderItemAndPersist(
                product_ulid: $orderItemDTO->getProductUlid(),
                currency: $orderItemDTO->getCurrency(),
                productName: $orderItemDTO->getProductName(),
                productCount: $orderItemDTO->getProductCount(),
                productPrice: $orderItemDTO->getProductPrice()
            );
        }

        $this->orderMaker->flush();

        return new CreateOrderCommandResult();
    }
}

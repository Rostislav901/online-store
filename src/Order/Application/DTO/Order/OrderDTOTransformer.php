<?php

namespace App\Order\Application\DTO\Order;

use App\Order\Domain\Aggregate\Order\Entity\Order;
use App\Order\Domain\Aggregate\Order\Entity\OrderItem;

class OrderDTOTransformer
{
    public function __construct()
    {
    }

    /**
     * @param Order[] $entities
     *
     * @return OrderDTOResponse[]
     */
    public function fromOrderListEntityToShortDTOList(array $entities): array
    {
        $res = [];
        foreach ($entities as $entity) {
            $res[] = $this->fromOrderEntityToShortDTO($entity);
        }

        return $res;
    }

    public function fromOrderEntityToShortDTO(Order $entity): OrderDTOResponse
    {
        $orderItems = $entity->getOrderItems()->toArray();
        $nameProducts = array_map(
            fn (OrderItem $orderItem) => $orderItem->getProductName(), $orderItems
        );

        return new OrderDTOResponse(
            order_ulid: $entity->getUlid(),
            status: $entity->getStatus()->value,
            productCount: count($nameProducts),
            products: $nameProducts
        );
    }

    public function fromOrderItemEntityToDTO(OrderItem $entity): OrderItemDTOResponse
    {
        return new OrderItemDTOResponse(
            product_ulid: $entity->getProductUlid()->getUlid(),
            productCount: $entity->getProductCount(),
            productPrice: $entity->getProductPrice(),
            currency: $entity->getCurrency(),
            productName: $entity->getProductName(),
            totalCost: $entity->getTotalCost()
        );
    }
}

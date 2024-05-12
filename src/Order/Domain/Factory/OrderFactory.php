<?php

namespace App\Order\Domain\Factory;

use App\Order\Domain\Aggregate\Order\Entity\Order;
use App\Order\Domain\Aggregate\Order\Enum\DeliveryType;
use App\Order\Domain\Aggregate\Order\Enum\OrderStatus;
use App\Order\Domain\Aggregate\Order\Enum\PaymentType;
use App\Order\Domain\Aggregate\Order\VO\ClientData;
use App\Shared\Domain\Security\UserFetcherInterface;
use App\Shared\Domain\Specification\UlidSpecification;
use App\Shared\Domain\VO\UserUlid;
use Proxies\__CG__\App\User\Domain\Aggregate\User\Entity\User;

class OrderFactory
{
    public function __construct(
        private readonly UserFetcherInterface $fetcher,
        private readonly UlidSpecification $ulidSpecification)
    {
    }

    public function create(
        string $status, string $deliveryAddress, string $deliveryType,
        float $deliveryCost, string $paymentType): Order
    {
        /**
         * @var User $client
         */
        $client = $this->fetcher->getUserAuth();
        $client_ulid = new UserUlid($client->getUlid(), $this->ulidSpecification);

        return new Order(
            status: OrderStatus::from($status),
            clientUlid: $client_ulid,
            clientData: new ClientData(
                name: $client->getName()->name,
                phoneNumber: $client->getPhone()->getPhone(),
                email: $client->getEmail()),
            deliveryAddress: $deliveryAddress,
            deliveryType: DeliveryType::from($deliveryType),
            deliveryCost: $deliveryCost,
            paymentType: PaymentType::from($paymentType),
        );
    }
}

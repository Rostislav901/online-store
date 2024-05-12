<?php

namespace App\Order\Domain\Aggregate\Order\Entity;

use App\Order\Domain\Aggregate\Order\Enum\DeliveryType;
use App\Order\Domain\Aggregate\Order\Enum\OrderStatus;
use App\Order\Domain\Aggregate\Order\Enum\PaymentType;
use App\Order\Domain\Aggregate\Order\VO\ClientData;
use App\Shared\Domain\Service\UlidGenerator;
use App\Shared\Domain\VO\UserUlid;
use Doctrine\Common\Collections\Collection;

class Order
{
    private readonly string $ulid;

    private \DateTimeImmutable $createdAt;

    private OrderStatus $status;

    private UserUlid $clientUlid;

    private ClientData $clientData;

    private string $deliveryAddress;
    private DeliveryType $deliveryType;

    private float $deliveryCost;

    private PaymentType $paymentType;

    private ?Collection $orderItems = null;

    public function __construct(
        OrderStatus $status, UserUlid $clientUlid,
        ClientData $clientData, string $deliveryAddress,
        DeliveryType $deliveryType, float $deliveryCost,
        PaymentType $paymentType)
    {
        $this->ulid = UlidGenerator::generate();
        $this->status = $status;
        $this->clientUlid = $clientUlid;
        $this->clientData = $clientData;
        $this->deliveryAddress = $deliveryAddress;
        $this->deliveryType = $deliveryType;
        $this->deliveryCost = $deliveryCost;
        $this->paymentType = $paymentType;
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getStatus(): OrderStatus
    {
        return $this->status;
    }

    public function getClientUlid(): UserUlid
    {
        return $this->clientUlid;
    }

    public function getClientData(): ClientData
    {
        return $this->clientData;
    }

    public function getDeliveryAddress(): string
    {
        return $this->deliveryAddress;
    }

    public function getDeliveryType(): DeliveryType
    {
        return $this->deliveryType;
    }

    public function getDeliveryCost(): float
    {
        return $this->deliveryCost;
    }

    public function getPaymentType(): PaymentType
    {
        return $this->paymentType;
    }

    /**
     * @return Collection<OrderItem>|null
     */
    public function getOrderItems(): ?Collection
    {
        return $this->orderItems;
    }

    public function setCreatedAtValue(): void
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function setStatus(OrderStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function setClientUlid(UserUlid $clientUlid): self
    {
        $this->clientUlid = $clientUlid;

        return $this;
    }

    public function setClientData(ClientData $clientData): self
    {
        $this->clientData = $clientData;

        return $this;
    }

    public function setDeliveryAddress(string $deliveryAddress): self
    {
        $this->deliveryAddress = $deliveryAddress;

        return $this;
    }

    public function setDeliveryType(DeliveryType $deliveryType): self
    {
        $this->deliveryType = $deliveryType;

        return $this;
    }

    public function setDeliveryCost(float $deliveryCost): self
    {
        $this->deliveryCost = $deliveryCost;

        return $this;
    }

    public function setPaymentType(PaymentType $paymentType): self
    {
        $this->paymentType = $paymentType;

        return $this;
    }

    public function setOrderItems(?Collection $orderItems): self
    {
        $this->orderItems = $orderItems;

        return $this;
    }
}

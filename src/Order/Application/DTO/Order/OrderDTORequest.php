<?php

namespace App\Order\Application\DTO\Order;

use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class OrderDTORequest
{
    #[NotBlank]
    #[Type(type: 'string')]
    #[Choice(choices: ['IN_PROGRESS', 'PAID', 'SHIPPED', 'COMPLETED', 'CANCELLED'])]
    private string $status;
    #[NotBlank]
    #[Type(type: 'string')]
    #[Length(min: 5, max: 50)]
    private string $deliveryAddress;
    #[NotBlank]
    #[Type(type: 'string')]
    #[Choice(choices: ['COURIER', 'PICKUP', 'MAIL'])]
    private string $deliveryType;
    #[NotBlank]
    #[Type(type: 'string')]
    #[Choice(choices: ['CREDIT CARD', 'BANK TRANSFER', 'CASH ON DELIVERY'])]
    private string $paymentType;
    #[NotBlank]
    #[Type(type: 'float')]
    private float $deliveryCost;
    public ?int $createdAt = null;

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDeliveryAddress(): string
    {
        return $this->deliveryAddress;
    }

    public function setDeliveryAddress(string $deliveryAddress): self
    {
        $this->deliveryAddress = $deliveryAddress;

        return $this;
    }

    public function getDeliveryType(): string
    {
        return $this->deliveryType;
    }

    public function setDeliveryType(string $deliveryType): self
    {
        $this->deliveryType = $deliveryType;

        return $this;
    }

    public function getPaymentType(): string
    {
        return $this->paymentType;
    }

    public function setPaymentType(string $paymentType): self
    {
        $this->paymentType = $paymentType;

        return $this;
    }

    public function getDeliveryCost(): float
    {
        return $this->deliveryCost;
    }

    public function setDeliveryCost(float $deliveryCost): self
    {
        $this->deliveryCost = $deliveryCost;

        return $this;
    }
}

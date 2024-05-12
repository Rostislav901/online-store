<?php

namespace App\ProductCatalog\Domain\Aggregate\Discount\Entity;

use App\ProductCatalog\Domain\Aggregate\Discount\Specification\DiscountSpecification;
use App\Shared\Domain\Service\UlidGenerator;
use App\Shared\Domain\VO\UserUlid;

class Discount
{
    private string $ulid;
    private float $discount;
    private UserUlid $user_ulid;
    private \DateTime $startDate;
    private \DateTime $endDate;

    public function __construct(
        float $discount,
        UserUlid $user_ulid,
        \DateTime $startDate,
        \DateTime $endDate,
        private readonly DiscountSpecification $discountSpecification)
    {
        $this->ulid = UlidGenerator::generate();
        $this->discount = $discount;
        $this->user_ulid = $user_ulid;
        $this->startDate = $startDate;
        $this->setEndDate($endDate);
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function setDiscount(float $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTime $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTime $endDate): self
    {
        $this->discountSpecification
            ->getDateSpecification()->endDateAfterStartDate(startDate: $this->startDate, endDate: $endDate);
        $this->endDate = $endDate;

        return $this;
    }

    public function getUserUlid(): UserUlid
    {
        return $this->user_ulid;
    }
}

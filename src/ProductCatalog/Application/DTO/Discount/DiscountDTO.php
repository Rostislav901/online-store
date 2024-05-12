<?php

namespace App\ProductCatalog\Application\DTO\Discount;

use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class DiscountDTO
{
    public function __construct(
        #[NotBlank]
        #[Type(type: 'float')]
        #[LessThan(value: 1, message: 'discount can\'t bee more than 100%')]
        public float $discount,
        #[DateTime(format: 'Y-m-d')]
        public readonly string $startDate,
        #[DateTime(format: 'Y-m-d')]
        public readonly string $endDate)
    {
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function getStartDateValue(): \DateTime
    {
        return \DateTime::createFromFormat('Y-m-d', $this->startDate);
    }

    public function getEndDateValue(): \DateTime
    {
        return \DateTime::createFromFormat('Y-m-d', $this->endDate);
    }
}

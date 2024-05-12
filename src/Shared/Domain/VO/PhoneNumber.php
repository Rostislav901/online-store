<?php

namespace App\Shared\Domain\VO;

use App\Shared\Domain\Specification\PhoneNumberSpecificationInterface;

class PhoneNumber
{
    protected readonly string $phone;

    public function __construct(
        string $phone, protected PhoneNumberSpecificationInterface $phoneNumberSpecification
    ) {
        $this->phone = $this->validPhoneNumber($phone);
    }

    public function validPhoneNumber(string $phone): string
    {
        $this->phoneNumberSpecification->satisfy($phone);

        return $phone;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }
}

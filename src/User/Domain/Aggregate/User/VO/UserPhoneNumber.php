<?php

namespace App\User\Domain\Aggregate\User\VO;

use App\Shared\Domain\VO\PhoneNumber;
use App\User\Domain\Aggregate\User\Specification\Interface\UserPhoneNumberSpecificationInterface;
use JetBrains\PhpStorm\Immutable;

#[Immutable]
final class UserPhoneNumber extends PhoneNumber
{
    public function __construct(
        string $phone,
        UserPhoneNumberSpecificationInterface $phoneNumberSpecification)
    {
        parent::__construct($phone, $phoneNumberSpecification);
        $this->phoneNumberSpecification = $phoneNumberSpecification;
    }
}

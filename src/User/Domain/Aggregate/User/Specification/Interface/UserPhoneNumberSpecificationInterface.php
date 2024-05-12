<?php

namespace App\User\Domain\Aggregate\User\Specification\Interface;

use App\Shared\Domain\Specification\PhoneNumberSpecificationInterface;

interface UserPhoneNumberSpecificationInterface extends PhoneNumberSpecificationInterface
{
    public function phoneIsUnique(string $phone): void;

    public function satisfy(string $phone): void;
}

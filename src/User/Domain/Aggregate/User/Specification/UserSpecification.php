<?php

namespace App\User\Domain\Aggregate\User\Specification;

use App\User\Domain\Aggregate\User\Specification\Interface\NameSpecificationInterface;
use App\User\Domain\Aggregate\User\Specification\Interface\UserEmailSpecificationInterface;
use App\User\Domain\Aggregate\User\Specification\Interface\UserPhoneNumberSpecificationInterface;

class UserSpecification
{
    public function __construct(
        private readonly UserEmailSpecificationInterface $emailSpecification,
        private readonly NameSpecificationInterface $nameSpecification,
        private readonly UserPhoneNumberSpecificationInterface $phoneNumberSpecification)
    {
    }

    public function getEmailSpecification(): UserEmailSpecificationInterface
    {
        return $this->emailSpecification;
    }

    public function getNameSpecification(): NameSpecificationInterface
    {
        return $this->nameSpecification;
    }

    public function getPhoneNumberSpecification(): UserPhoneNumberSpecificationInterface
    {
        return $this->phoneNumberSpecification;
    }
}

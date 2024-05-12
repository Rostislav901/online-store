<?php

namespace App\User\Domain\Aggregate\User\Specification\Realization;

use App\Shared\Domain\Specification\PhoneNumberSpecification;
use App\User\Domain\Aggregate\User\Specification\Exception\PhoneAlreadyExistException;
use App\User\Domain\Aggregate\User\Specification\Interface\UserPhoneNumberSpecificationInterface;
use App\User\Domain\Repository\UserRepositoryInterface;

class UserPhoneNumberSpecification extends PhoneNumberSpecification implements UserPhoneNumberSpecificationInterface
{
    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {
    }

    public function phoneIsUnique(string $phone): void
    {
        true !== $this->userRepository->existByPhone($phone) ?: throw new PhoneAlreadyExistException();
    }

    public function satisfy(string $phone): void
    {
        parent::satisfy($phone);
        $this->phoneIsUnique($phone);
    }
}

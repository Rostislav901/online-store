<?php

namespace App\User\Domain\Aggregate\User\Specification\Realization;

use App\Shared\Domain\Specification\EmailSpecification;
use App\User\Domain\Aggregate\User\Specification\Exception\EmailAlreadyExistException;
use App\User\Domain\Aggregate\User\Specification\Interface\UserEmailSpecificationInterface;
use App\User\Domain\Repository\UserRepositoryInterface;

class UserEmailSpecification extends EmailSpecification implements UserEmailSpecificationInterface
{
    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {
    }

    public function emailIsUnique(string $email): void
    {
        true !== $this->userRepository->existByEmail($email) ?: throw new EmailAlreadyExistException();
    }

    public function satisfy(string $email): void
    {
        parent::satisfy($email);
        $this->emailIsUnique($email);
    }
}

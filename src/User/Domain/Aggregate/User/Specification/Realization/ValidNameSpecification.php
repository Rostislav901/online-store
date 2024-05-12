<?php

namespace App\User\Domain\Aggregate\User\Specification\Realization;

use App\Shared\Domain\Service\AssertService;
use App\User\Domain\Aggregate\User\Specification\Exception\NameAlreadyExistException;
use App\User\Domain\Aggregate\User\Specification\Exception\NameLengthException;
use App\User\Domain\Aggregate\User\Specification\Interface\NameSpecificationInterface;
use App\User\Domain\Repository\UserRepositoryInterface;

class ValidNameSpecification implements NameSpecificationInterface
{
    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {
    }

    public function nameIsValidName(string $name): void
    {
        try {
            AssertService::lengthBetween($name, 7, 20);
        } catch (\InvalidArgumentException) {
            throw new NameLengthException();
        }
    }

    public function nameIsUnique(string $name): void
    {
        true !== $this->userRepository->existByName($name) ?: throw new NameAlreadyExistException();
    }

    public function nameSatisfy(string $name): void
    {
        $this->nameIsValidName($name);
        $this->nameIsUnique($name);
    }
}

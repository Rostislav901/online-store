<?php

namespace App\User\Domain\Aggregate\User\Specification\Interface;

use App\Shared\Domain\Specification\EmailSpecificationInterface;

interface UserEmailSpecificationInterface extends EmailSpecificationInterface
{
    public function emailIsUnique(string $email): void;

    public function satisfy(string $email): void;
}

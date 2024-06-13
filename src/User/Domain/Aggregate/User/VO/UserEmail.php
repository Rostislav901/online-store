<?php

namespace App\User\Domain\Aggregate\User\VO;

use App\Shared\Domain\VO\Email;
use App\User\Domain\Aggregate\User\Specification\Interface\UserEmailSpecificationInterface;
use JetBrains\PhpStorm\Immutable;

#[Immutable]
class UserEmail extends Email
{
    public function __construct(string $email, UserEmailSpecificationInterface $emailSpecification)
    {
        parent::__construct($email, $emailSpecification);
        $this->emailSpecification = $emailSpecification;
    }
}

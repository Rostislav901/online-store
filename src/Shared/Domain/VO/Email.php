<?php

namespace App\Shared\Domain\VO;

use App\Shared\Domain\Specification\EmailSpecificationInterface;

class Email
{
    protected readonly string $email;

    public function __construct(
        string $email,
        protected EmailSpecificationInterface $emailSpecification)
    {
        $this->email = $this->validEmail($email);
    }

    public function validEmail(string $email): string
    {
        $this->emailSpecification->satisfy($email);

        return $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}

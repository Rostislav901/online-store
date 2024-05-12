<?php

namespace App\Shared\Domain\Specification;

use App\Shared\Domain\Service\AssertService;
use App\Shared\Domain\Specification\Exception\EmailNotValidException;

class EmailSpecification implements EmailSpecificationInterface
{
    public function satisfy(string $email): void
    {
        try {
            AssertService::email($email);
        } catch (\InvalidArgumentException) {
            throw new EmailNotValidException();
        }
    }
}

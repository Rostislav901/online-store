<?php

namespace App\Shared\Domain\Specification;

interface EmailSpecificationInterface
{
    public function satisfy(string $email): void;
}

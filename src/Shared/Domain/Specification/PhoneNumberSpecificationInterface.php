<?php

namespace App\Shared\Domain\Specification;

interface PhoneNumberSpecificationInterface
{
    public function satisfy(string $phone): void;
}

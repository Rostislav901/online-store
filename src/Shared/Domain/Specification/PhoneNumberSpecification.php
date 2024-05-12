<?php

namespace App\Shared\Domain\Specification;

use App\Shared\Domain\Service\AssertService;
use App\Shared\Domain\Specification\Exception\PhoneNotValidException;

class PhoneNumberSpecification implements PhoneNumberSpecificationInterface
{
    public function satisfy(string $phone): void
    {
        $pattern = '/^380\d{9}$/';
        try {
            AssertService::true(boolval(preg_match($pattern, $phone)));
        } catch (\InvalidArgumentException) {
            throw new PhoneNotValidException();
        }
    }
}

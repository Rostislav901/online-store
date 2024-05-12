<?php

namespace App\Shared\Domain\Specification;

use App\Shared\Domain\Specification\Exception\UlidNotValidException;

class UlidSpecification
{
    public function satisfy(string $ulid): void
    {
        $len = 26 !== strlen($ulid);
        $symbol10 = !preg_match('/^[0-9A-HJKMNP-TV-Z]{10}$/', substr($ulid, 0, 10));
        $symbol16 = !preg_match('/^[0-9A-HJKMNP-TV-Z]{16}$/', substr($ulid, 10));

        if ($len || $symbol10 || $symbol16) {
            throw new UlidNotValidException();
        }
    }
}

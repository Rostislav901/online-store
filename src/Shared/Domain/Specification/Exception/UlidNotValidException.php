<?php

namespace App\Shared\Domain\Specification\Exception;

class UlidNotValidException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Ulid not valid');
    }
}

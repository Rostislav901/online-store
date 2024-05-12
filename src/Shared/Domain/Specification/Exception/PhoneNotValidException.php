<?php

namespace App\Shared\Domain\Specification\Exception;

class PhoneNotValidException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Phone provided does not match the phone pattern: 380 start and nine number symbols');
    }
}

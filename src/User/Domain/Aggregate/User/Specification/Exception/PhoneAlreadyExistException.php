<?php

namespace App\User\Domain\Aggregate\User\Specification\Exception;

class PhoneAlreadyExistException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Phone must bee unique');
    }
}

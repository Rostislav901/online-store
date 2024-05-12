<?php

namespace App\User\Domain\Aggregate\User\Specification\Exception;

class NameLengthException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('The name length must be from 7 to 20 characters');
    }
}

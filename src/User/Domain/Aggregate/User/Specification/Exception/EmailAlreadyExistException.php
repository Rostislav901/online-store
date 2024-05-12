<?php

namespace App\User\Domain\Aggregate\User\Specification\Exception;

class EmailAlreadyExistException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Email must bee unique');
    }
}

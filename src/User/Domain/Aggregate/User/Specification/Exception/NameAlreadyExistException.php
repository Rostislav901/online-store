<?php

namespace App\User\Domain\Aggregate\User\Specification\Exception;

class NameAlreadyExistException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Name must bee unique');
    }
}

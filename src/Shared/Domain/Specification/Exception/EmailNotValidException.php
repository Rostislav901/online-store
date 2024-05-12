<?php

namespace App\Shared\Domain\Specification\Exception;

class EmailNotValidException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Email provided does not match the email pattern');
    }
}

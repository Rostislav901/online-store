<?php

namespace App\User\Application\Exception;

class UserNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('User not found');
    }
}

<?php

namespace App\Shared\Domain\Security;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

interface UserAuthInterface extends UserInterface, PasswordAuthenticatedUserInterface
{
    public function getUlid(): string;

    public function getEmail(): string;
}

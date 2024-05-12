<?php

namespace App\User\Infrastructure\Service;

use App\User\Domain\Aggregate\User\Entity\User;
use App\User\Domain\Service\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface as SecurityUserPasswordHasherInterface;

class UserPasswordHasher implements UserPasswordHasherInterface
{
    public function __construct(private readonly SecurityUserPasswordHasherInterface $hasher)
    {
    }

    public function hash(User $user, string $password): string
    {
        return $this->hasher->hashPassword($user, $password);
    }
}

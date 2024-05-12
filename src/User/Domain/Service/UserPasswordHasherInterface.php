<?php

namespace App\User\Domain\Service;

use App\User\Domain\Aggregate\User\Entity\User;

interface UserPasswordHasherInterface
{
    public function hash(User $user, string $password): string;
}

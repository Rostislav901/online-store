<?php

namespace App\User\Domain\Repository;

use App\User\Domain\Aggregate\User\Entity\User;

interface UserRepositoryInterface
{
    public function add(User $user): string;

    public function findOneByEmail(string $email): User;

    public function findOneByPhone(string $phone): User;

    public function findOneByName(string $name): User;

    public function existByEmail(string $email): bool;

    public function existByPhone(string $phone): bool;

    public function existByName(string $name): bool;

    public function findOneByUlid(string $ulid): User;
}

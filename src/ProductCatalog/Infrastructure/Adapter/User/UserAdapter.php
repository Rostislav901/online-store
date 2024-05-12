<?php

namespace App\ProductCatalog\Infrastructure\Adapter\User;

use App\User\Application\DTO\UserResponseDTO;

class UserAdapter
{
    public function __construct(
        private readonly UserAPIByUsernameInterface $userAPIByEmail,
        private readonly UserAPIByUlidInterface $userAPIByUlid)
    {
    }

    public function getUserUlidByUsername(string $username): string
    {
        return $this->userAPIByEmail->getUserDataByUsername($username)->getUserUld();
    }

    public function getUserDataByUlid(string $ulid): UserResponseDTO
    {
        return $this->userAPIByUlid->getUserDataByUlid($ulid);
    }
}

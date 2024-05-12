<?php

namespace App\ProductCatalog\Infrastructure\Adapter\User;

use App\User\Application\DTO\UserResponseDTO;

interface UserAPIByUlidInterface
{
    public function getUserDataByUlid(string $user_ulid): UserResponseDTO;
}

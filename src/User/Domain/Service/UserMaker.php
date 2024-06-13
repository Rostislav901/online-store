<?php

namespace App\User\Domain\Service;

use App\User\Domain\Factory\UserFactory;
use App\User\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserMaker
{
    public function __construct(private readonly UserFactory $userFactory, private readonly UserRepositoryInterface $userRepository)
    {
    }

    public function makeUser(
        string $name, string $phone,
        string $email, string $password
    ): UserInterface {
        $user = $this->userFactory->create(
            name: $name,
            phone: $phone,
            email: $email,
            password: $password
        );

        $this->userRepository->add($user);

        return $user;
    }
}

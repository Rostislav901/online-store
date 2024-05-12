<?php

namespace App\User\Domain\Factory;

use App\User\Domain\Aggregate\User\Entity\User;
use App\User\Domain\Aggregate\User\Specification\UserSpecification;
use App\User\Domain\Aggregate\User\VO\Name;
use App\User\Domain\Aggregate\User\VO\UserEmail;
use App\User\Domain\Aggregate\User\VO\UserPhoneNumber;
use App\User\Domain\Service\UserPasswordHasherInterface;

class UserFactory
{
    public function __construct(
        private readonly UserPasswordHasherInterface $hasher,
        private readonly UserSpecification $specification)
    {
    }

    public function create(string $name, string $phone, string $email, string $password): User
    {
        $user = new User(
            email: new UserEmail($email, $this->specification->getEmailSpecification()),
            phone: new UserPhoneNumber($phone, $this->specification->getPhoneNumberSpecification()),
            name: new Name($name, $this->specification->getNameSpecification())
        );

        $user->setPassword($password, $this->hasher);

        return $user;
    }
}

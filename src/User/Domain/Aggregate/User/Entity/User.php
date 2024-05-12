<?php

namespace App\User\Domain\Aggregate\User\Entity;

use App\Shared\Domain\Security\UserAuthInterface;
use App\Shared\Domain\Service\UlidGenerator;
use App\User\Domain\Aggregate\User\VO\Name;
use App\User\Domain\Aggregate\User\VO\UserEmail;
use App\User\Domain\Aggregate\User\VO\UserPhoneNumber;
use App\User\Domain\Service\UserPasswordHasherInterface;

class User implements UserAuthInterface
{
    private string $ulid;
    private UserEmail $email;
    private UserPhoneNumber $phone;
    private Name $name;
    private ?string $password = null;
    /**
     * @var string[]
     */
    private array $roles = ['ROLE_USER'];
    private \DateTimeImmutable $createdAt;

    public function __construct(UserEmail $email, UserPhoneNumber $phone, Name $name)
    {
        $this->ulid = UlidGenerator::generate();
        $this->email = $email;
        $this->phone = $phone;
        $this->name = $name;
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function setUlid(string $ulid): void
    {
        $this->ulid = $ulid;
    }

    public function getEmail(): string
    {
        return $this->email->getEmail();
    }

    public function setEmail(UserEmail $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password, UserPasswordHasherInterface $hasher): void
    {
        $this->password = $hasher->hash($this, $password);
    }

    public function getPhone(): UserPhoneNumber
    {
        return $this->phone;
    }

    public function setPhone(UserPhoneNumber $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function setName(Name $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAtValue(): self
    {
        $this->createdAt = new \DateTimeImmutable();

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return $this->email->getEmail();
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function eraseCredentials()
    {
    }
}

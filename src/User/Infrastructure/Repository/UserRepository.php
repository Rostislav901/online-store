<?php

namespace App\User\Infrastructure\Repository;

use App\User\Application\Exception\UserNotFoundException;
use App\User\Domain\Aggregate\User\Entity\User;
use App\User\Domain\Repository\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry,
        private EntityManagerInterface $e_m)
    {
        parent::__construct($registry, User::class);
    }

    public function add(User $user): string
    {
        $this->e_m->persist($user);
        $this->e_m->flush();

        return $user->getUlid();
    }

    public function findOneByEmail(string $email): User
    {
        $res = $this->findOneBy(['email.email' => $email]);

        return null === $res ? throw new UserNotFoundException() : $res;
    }

    public function findOneByPhone(string $phone): User
    {
        $res = $this->findOneBy(['phone.phone' => $phone]);

        return null === $res ? throw new UserNotFoundException() : $res;
    }

    public function findOneByName(string $name): User
    {
        $res = $this->findOneBy(['name.name' => $name]);

        return null === $res ? throw new UserNotFoundException() : $res;
    }

    public function existByEmail(string $email): bool
    {
        return null !== $this->findOneBy(['email.email' => $email]);
    }

    public function existByPhone(string $phone): bool
    {
        return null !== $this->findOneBy(['phone.phone' => $phone]);
    }

    public function existByName(string $name): bool
    {
        return null !== $this->findOneBy(['name.name' => $name]);
    }

    public function findOneByUlid(string $ulid): User
    {
        $res = $this->findOneBy(['ulid' => $ulid]);

        return null !== $res ? $res : throw new UserNotFoundException();
    }
}

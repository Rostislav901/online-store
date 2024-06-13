<?php

namespace App\Tests\Integration\User\Infrastructure\Repository;

use App\Tests\Integration\AbstractRepositoryTest;
use App\User\Application\Exception\UserNotFoundException;
use App\User\Domain\Aggregate\User\Entity\User;
use App\User\Domain\Aggregate\User\Specification\Realization\UserEmailSpecification;
use App\User\Domain\Aggregate\User\Specification\Realization\UserPhoneNumberSpecification;
use App\User\Domain\Aggregate\User\Specification\Realization\ValidNameSpecification;
use App\User\Domain\Aggregate\User\VO\Name;
use App\User\Domain\Aggregate\User\VO\UserEmail;
use App\User\Domain\Aggregate\User\VO\UserPhoneNumber;
use App\User\Domain\Service\UserPasswordHasherInterface;
use App\User\Infrastructure\Repository\UserRepository;

class UserRepositoryTest extends AbstractRepositoryTest
{
    private readonly UserRepository $userRepository;
    private readonly UserPasswordHasherInterface $hasher;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = $this->getRepositoryForEntity(User::class);
        $this->hasher = $this->getContainer()->get('App\User\Domain\Service\UserPasswordHasherInterface');
    }

    public function testAdd(): void
    {
        $user = $this->createUser();

        $actual = $this->userRepository->add($user);

        $this->assertCount(1, $this->userRepository->findAll());
        $this->assertNotNull($this->userRepository->findOneBy(['ulid' => $actual]));
    }

    public function testFindOneByEmailThrowException(): void
    {
        $this->expectException(UserNotFoundException::class);
        $this->userRepository->findOneByEmail('test-email');
    }

    public function testFindOneByEmail(): void
    {
        $user = $this->createUser();

        $this->em->persist($user);
        $this->em->flush();

        $actual = $this->userRepository->findOneByEmail('test-email@mail.com');

        $this->assertEquals($user->getEmail(), $actual->getEmail());
        $this->assertEquals($user, $actual);
    }

    public function testFindOneByPhoneThrowException(): void
    {
        $this->expectException(UserNotFoundException::class);
        $this->userRepository->findOneByPhone('380567545288');
    }

    public function testFindOneByPhone(): void
    {
        $user = $this->createUser();

        $this->em->persist($user);
        $this->em->flush();

        $actual = $this->userRepository->findOneByPhone('380567545288');

        $this->assertEquals($user->getPhone()->getPhone(), $actual->getPhone()->getPhone());
        $this->assertEquals($user, $actual);
    }

    public function testFindOneByNameThrowException(): void
    {
        $this->expectException(UserNotFoundException::class);
        $this->userRepository->findOneByName('test-name');
    }

    public function testFindOneByName(): void
    {
        $user = $this->createUser();

        $this->em->persist($user);
        $this->em->flush();

        $actual = $this->userRepository->findOneByName('test-name');

        $this->assertEquals($user->getName()->getName(), $actual->getName()->getName());
        $this->assertEquals($user, $actual);
    }

    public function testExistByEmailReturnFalse(): void
    {
        $this->assertFalse($this->userRepository->existByEmail('test-email'));
    }

    public function testExistByEmailReturnTrue(): void
    {
        $this->em->persist($this->createUser());
        $this->em->flush();
        $this->assertTrue($this->userRepository->existByEmail('test-email@mail.com'));
    }

    public function testExistByPhoneReturnFalse(): void
    {
        $this->assertFalse($this->userRepository->existByPhone('test-phone'));
    }

    public function testExistByPhoneReturnTrue(): void
    {
        $this->em->persist($this->createUser());
        $this->em->flush();
        $this->assertTrue($this->userRepository->existByPhone('380567545288'));
    }

    public function testExistByNameReturnFalse(): void
    {
        $this->assertFalse($this->userRepository->existByName('test-name'));
    }

    public function testExistByNameReturnTrue(): void
    {
        $this->em->persist($this->createUser());
        $this->em->flush();
        $this->assertTrue($this->userRepository->existByName('test-name'));
    }

    public function createUser(): User
    {
        $userEmail = new UserEmail('test-email@mail.com', new UserEmailSpecification($this->userRepository));
        $userPhone = new UserPhoneNumber('380567545288', new UserPhoneNumberSpecification($this->userRepository));
        $userName = new Name('test-name', new ValidNameSpecification($this->userRepository));
        $user = new User($userEmail, $userPhone, $userName);
        $user->setPassword('test-password', $this->hasher);

        return $user;
    }

    public function testFindOneByUlidThrowException(): void
    {
        $this->expectException(UserNotFoundException::class);

        $this->userRepository->findOneByUlid('test-ulid');
    }

    public function testFindOneByUlid(): void
    {
        $user = $this->createUser();

        $this->em->persist($user);
        $this->em->flush();

        $ulid = $user->getUlid();

        $actual = $this->userRepository->findOneByUlid($ulid);

        $this->assertEquals($ulid, $actual->getUlid());

        $this->assertEquals($user, $actual);
    }
}

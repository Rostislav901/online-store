<?php

namespace App\Tests\Integration\User\Domain\Factory;

use App\User\Domain\Aggregate\User\Entity\User;
use App\User\Domain\Aggregate\User\Specification\Interface\UserEmailSpecificationInterface;
use App\User\Domain\Aggregate\User\Specification\Interface\UserPhoneNumberSpecificationInterface;
use App\User\Domain\Aggregate\User\Specification\Realization\ValidNameSpecification;
use App\User\Domain\Aggregate\User\Specification\UserSpecification;
use App\User\Domain\Factory\UserFactory;
use App\User\Domain\Service\UserPasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserFactoryTest extends KernelTestCase
{
    protected readonly UserPasswordHasherInterface $hasher;


    protected function setUp(): void
    {
        parent::setUp();

        $this->hasher = $this->getContainer()->get('App\User\Domain\Service\UserPasswordHasherInterface');
    }

    public function testCreate(): void
    {
        $userSpecification = $this->createMock(UserSpecification::class);

        $userEmailSpecification = $this->createMock(UserEmailSpecificationInterface::class);
        $userEmailSpecification->expects($this->once())->method('satisfy')->with('test-email');

        $userPhoneSpecification = $this->createMock(UserPhoneNumberSpecificationInterface::class);
        $userPhoneSpecification->expects($this->once())->method('satisfy')->with('test-phone');

        $userNameSpecification = $this->createMock(ValidNameSpecification::class);
        $userNameSpecification->expects($this->once())->method('nameSatisfy')->with('test-name');

        $userSpecification->expects($this->once())
            ->method('getNameSpecification')
            ->willReturn($userNameSpecification);

        $userSpecification->expects($this->once())
            ->method('getEmailSpecification')
            ->willReturn($userEmailSpecification);

        $userSpecification->expects($this->once())
            ->method('getPhoneNumberSpecification')
            ->willReturn($userPhoneSpecification);

        $actual = (new UserFactory($this->hasher, $userSpecification))->create(
            name: 'test-name',
            phone: 'test-phone',
            email: 'test-email',
            password: 'test-password'
        );

        $this->assertEquals(User::class, get_class($actual));

        $this->assertEquals('test-name', $actual->getName()->name);
        $this->assertEquals('test-phone', $actual->getPhone()->getPhone());
        $this->assertEquals('test-email', $actual->getEmail());
        $this->assertNotEquals('test-password', $actual->getPassword());
    }
}

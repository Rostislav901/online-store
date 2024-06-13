<?php

namespace App\Tests\Unit\User\Application\DTO;

use App\User\Application\DTO\UserDTOTransformer;
use App\User\Application\DTO\UserResponseDTO;
use App\User\Domain\Aggregate\User\Entity\User;
use App\User\Domain\Aggregate\User\Specification\Interface\NameSpecificationInterface;
use App\User\Domain\Aggregate\User\VO\Name;
use App\User\Domain\Aggregate\User\VO\UserEmail;
use App\User\Domain\Aggregate\User\VO\UserPhoneNumber;
use PHPUnit\Framework\TestCase;

class UserDTOTransformerTest extends TestCase
{
    public function testFromEntityToDTO(): void
    {
        $email = $this->createMock(UserEmail::class);
        $phone = $this->createMock(UserPhoneNumber::class);
        $nameSpecification = $this->createMock(NameSpecificationInterface::class);
        $nameSpecification->expects($this->once())
                    ->method('nameSatisfy')
                    ->with('test-username');
        $user = new User(
            email: $email,
            phone: $phone,
            name: new Name('test-username', $nameSpecification)
        );
        $time = new \DateTimeImmutable();
        $user->setCreatedAt($time);

        $timestamp = $time->getTimestamp();

        $actual = (new UserDTOTransformer())->fromEntityToDTO($user);

        $this->assertEquals(UserResponseDTO::class, get_class($actual));
        $this->assertEquals('test-username', $actual->name);
        $this->assertEquals($timestamp, $actual->registrationDate);
        $this->assertEquals(new UserResponseDTO('test-username', $timestamp), $actual);
    }
}

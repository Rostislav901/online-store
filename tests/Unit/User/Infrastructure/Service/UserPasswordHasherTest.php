<?php

namespace App\Tests\Unit\User\Infrastructure\Service;

use App\User\Domain\Aggregate\User\Entity\User;
use App\User\Infrastructure\Service\UserPasswordHasher;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface as SecurityUserPasswordHasherInterface;

class UserPasswordHasherTest extends TestCase
{
    public function testHash(): void
    {
        $user = $this->createMock(User::class);

        $userPasswordHasher = $this->createMock(SecurityUserPasswordHasherInterface::class);

        $userPasswordHasher->expects($this->once())
                    ->method('hashPassword')
                    ->with($user, 'test-password')
                    ->willReturn('test-hash');

        $actual = (new UserPasswordHasher($userPasswordHasher))->hash($user, 'test-password');

        $this->assertEquals('test-hash', $actual);
    }
}

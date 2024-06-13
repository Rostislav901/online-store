<?php

namespace App\Tests\Unit\User\Domain\Aggregate\User\Specification;

use App\Shared\Domain\Specification\Exception\EmailNotValidException;
use App\User\Domain\Aggregate\User\Specification\Exception\EmailAlreadyExistException;
use App\User\Domain\Aggregate\User\Specification\Realization\UserEmailSpecification;
use App\User\Domain\Repository\UserRepositoryInterface;
use PHPUnit\Framework\TestCase;

class UserEmailSpecificationTest extends TestCase
{
    private readonly UserRepositoryInterface $userRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = $this->createMock(UserRepositoryInterface::class);
    }

    public function testEmailIsUniqueThrowException(): void
    {
        $this->userRepository->expects($this->once())
            ->method('existByEmail')
            ->with('test-email')
            ->willReturn(true);

        $this->expectException(EmailAlreadyExistException::class);

        (new UserEmailSpecification($this->userRepository))->emailIsUnique('test-email');
    }

    public function testEmailIsUnique(): void
    {
        $this->userRepository->expects($this->once())
            ->method('existByEmail')
            ->with('test-email')
            ->willReturn(false);

        (new UserEmailSpecification($this->userRepository))->emailIsUnique('test-email');
    }

    public function testSatisfyThrowValidationException(): void
    {
        $this->expectException(EmailNotValidException::class);

        (new UserEmailSpecification($this->userRepository))->satisfy('test-email');
    }

    public function testSatisfyThrowAlreadyExistException(): void
    {
        $this->userRepository->expects($this->once())
            ->method('existByEmail')
            ->with('test-email@mail.com')
            ->willReturn(true);

        $this->expectException(EmailAlreadyExistException::class);

        (new UserEmailSpecification($this->userRepository))->satisfy('test-email@mail.com');

    }

    public function testSatisfy(): void
    {
        $this->userRepository->expects($this->once())
            ->method('existByEmail')
            ->with('test-email@mail.com')
            ->willReturn(false);

        (new UserEmailSpecification($this->userRepository))->satisfy('test-email@mail.com');
    }
}

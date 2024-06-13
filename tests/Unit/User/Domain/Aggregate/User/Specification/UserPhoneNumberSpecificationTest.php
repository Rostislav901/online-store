<?php

namespace App\Tests\Unit\User\Domain\Aggregate\User\Specification;

use App\Shared\Domain\Specification\Exception\PhoneNotValidException;
use App\User\Domain\Aggregate\User\Specification\Exception\PhoneAlreadyExistException;
use App\User\Domain\Aggregate\User\Specification\Realization\UserPhoneNumberSpecification;
use App\User\Domain\Repository\UserRepositoryInterface;
use PHPUnit\Framework\TestCase;

class UserPhoneNumberSpecificationTest extends TestCase
{
    private readonly UserRepositoryInterface $userRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = $this->createMock(UserRepositoryInterface::class);
    }

    public function testPhoneNumberIsUniqueThrowException(): void
    {
        $this->userRepository->expects($this->once())
            ->method('existByPhone')
            ->with('test-phone')
            ->willReturn(true);

        $this->expectException(PhoneAlreadyExistException::class);

        (new UserPhoneNumberSpecification($this->userRepository))->phoneIsUnique('test-phone');
    }

    public function testPhoneNumberIsUnique(): void
    {
        $this->userRepository->expects($this->once())
            ->method('existByPhone')
            ->with('test-phone')
            ->willReturn(false);

        (new UserPhoneNumberSpecification($this->userRepository))->phoneIsUnique('test-phone');
    }

    public function testSatisfyThrowValidationException(): void
    {
        $this->expectException(PhoneNotValidException::class);

        (new UserPhoneNumberSpecification($this->userRepository))->satisfy('test-phone');
    }

    public function testSatisfyThrowAlreadyExistException(): void
    {
        $this->userRepository->expects($this->once())
            ->method('existByPhone')
            ->with('380662343188')
            ->willReturn(true);

        $this->expectException(PhoneAlreadyExistException::class);

        (new UserPhoneNumberSpecification($this->userRepository))->satisfy('380662343188');

    }

    public function testSatisfy(): void
    {
        $this->userRepository->expects($this->once())
            ->method('existByPhone')
            ->with('380662343188')
            ->willReturn(false);

        (new UserPhoneNumberSpecification($this->userRepository))->satisfy('380662343188');
    }
}

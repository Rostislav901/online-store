<?php

namespace App\Tests\Unit\User\Domain\Aggregate\User\Specification;

use App\User\Domain\Aggregate\User\Specification\Exception\NameAlreadyExistException;
use App\User\Domain\Aggregate\User\Specification\Exception\NameLengthException;
use App\User\Domain\Aggregate\User\Specification\Realization\ValidNameSpecification;
use App\User\Domain\Repository\UserRepositoryInterface;
use PHPUnit\Framework\TestCase;

class UserNameSpecificationTest extends TestCase
{
    private readonly UserRepositoryInterface $userRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = $this->createMock(UserRepositoryInterface::class);
    }

    public function testNameIsValidNameThrowException(): void
    {
        $this->expectException(NameLengthException::class);


        (new ValidNameSpecification($this->userRepository))->nameIsValidName($this->getFailedName());
    }

    public function testNameIsUniqueThrowException(): void
    {
        $this->userRepository->expects($this->once())
            ->method('existByName')
            ->with('test-name')
            ->willReturn(true);

        $this->expectException(NameAlreadyExistException::class);

        (new ValidNameSpecification($this->userRepository))->nameIsUnique('test-name');
    }

    public function testEmailIsUnique(): void
    {
        $this->userRepository->expects($this->once())
            ->method('existByName')
            ->with('test-name')
            ->willReturn(false);

        (new ValidNameSpecification($this->userRepository))->nameIsUnique('test-name');
    }

    public function testNameSatisfyThrowValidationException(): void
    {
        $this->expectException(NameLengthException::class);
        (new ValidNameSpecification($this->userRepository))->nameSatisfy($this->getFailedName());
    }

    public function testNameSatisfyThrowAlreadyExisitException(): void
    {
        $this->userRepository->expects($this->once())
            ->method('existByName')
            ->with('moreThan6LessThan21')
            ->willReturn(true);

        $this->expectException(NameAlreadyExistException::class);

        (new ValidNameSpecification($this->userRepository))->nameSatisfy('moreThan6LessThan21');
    }

    public function testNameSatisfy(): void
    {
        $this->userRepository->expects($this->once())
            ->method('existByName')
            ->with('moreThan6LessThan21')
            ->willReturn(false);


        (new ValidNameSpecification($this->userRepository))->nameSatisfy('moreThan6LessThan21');
    }

    public function getFailedName(): string
    {
        $failedNames = [
            'lessThan7' => '123456',
            'moreThan20' => '123456789012345678901',
        ];

        return $failedNames[array_rand($failedNames)];
    }
}

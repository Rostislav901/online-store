<?php

namespace App\Tests\Unit\User\Application\UseCase\Query\FindAboutMeInfo;

use App\Shared\Domain\Security\UserFetcherInterface;
use App\User\Application\UseCase\Query\User\FindAboutMeInfo\FindAboutMeInfoQuery;
use App\User\Application\UseCase\Query\User\FindAboutMeInfo\FindAboutMeInfoQueryHandler;
use App\User\Application\UseCase\Query\User\FindAboutMeInfo\FindAboutMeInfoQueryResult;
use App\User\Domain\Aggregate\User\Entity\User;
use App\User\Domain\Aggregate\User\Specification\Interface\NameSpecificationInterface;
use App\User\Domain\Aggregate\User\Specification\Interface\UserEmailSpecificationInterface;
use App\User\Domain\Aggregate\User\Specification\Interface\UserPhoneNumberSpecificationInterface;
use App\User\Domain\Aggregate\User\VO\Name;
use App\User\Domain\Aggregate\User\VO\UserEmail;
use App\User\Domain\Aggregate\User\VO\UserPhoneNumber;
use PHPUnit\Framework\TestCase;

class FindAboutMeInfoQueryHandlerTest extends TestCase
{
    public function testInvoke(): void
    {
        $nameSpecification = $this->createMock(NameSpecificationInterface::class);
        $nameSpecification->expects($this->once())->method('nameSatisfy')->with('test-name');

        $phoneSpecification = $this->createMock(UserPhoneNumberSpecificationInterface::class);
        $phoneSpecification->expects($this->once())->method('satisfy')->with('test-phone');

        $emailSpecification = $this->createMock(UserEmailSpecificationInterface::class);
        $emailSpecification->expects($this->once())->method('satisfy')->with('test-email');
        $time = new \DateTimeImmutable();
        $user = new User(
            email: new UserEmail('test-email', $emailSpecification),
            phone: new UserPhoneNumber('test-phone', $phoneSpecification),
            name: new Name('test-name', $nameSpecification)
        );
        $user->setCreatedAt($time);

        $userFetcher = $this->createMock(UserFetcherInterface::class);

        $userFetcher->expects($this->once())
            ->method('getUserAuth')
            ->willReturn($user);

        $actual = (new FindAboutMeInfoQueryHandler($userFetcher))(new FindAboutMeInfoQuery());

        $this->assertEquals(FindAboutMeInfoQueryResult::class, get_class($actual));
        $this->assertEquals('test-name', $actual->name);
        $this->assertEquals('test-phone', $actual->phone);
        $this->assertEquals('test-email', $actual->email);
        $this->assertEquals($time->getTimestamp(), $actual->registrationDate);
    }
}

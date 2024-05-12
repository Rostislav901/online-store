<?php

namespace App\User\Application\UseCase\Query\User\FindAboutMeInfo;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Shared\Domain\Security\UserFetcherInterface;
use App\User\Domain\Aggregate\User\Entity\User;

class FindAboutMeInfoQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly UserFetcherInterface $userFetcher)
    {
    }

    public function __invoke(FindAboutMeInfoQuery $query): FindAboutMeInfoQueryResult
    {
        /**
         * @var User $user
         */
        $user = $this->userFetcher->getUserAuth();

        return new FindAboutMeInfoQueryResult(
            name: $user->getName()->name,
            email: $user->getEmail(),
            phone: $user->getPhone()->getPhone(),
            registrationDate: $user->getCreatedAt()->getTimestamp()
        );
    }
}

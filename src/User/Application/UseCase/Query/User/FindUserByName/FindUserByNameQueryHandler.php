<?php

namespace App\User\Application\UseCase\Query\User\FindUserByName;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\User\Application\DTO\UserDTOTransformer;
use App\User\Domain\Repository\UserRepositoryInterface;

class FindUserByNameQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly UserDTOTransformer $transformer)
    {
    }

    public function __invoke(FindUserByNameQuery $query): FindUserByNameQueryResult
    {
        $username = $query->name;

        $user = $this->userRepository->findOneByName($username);
        $dto = $this->transformer->fromEntityToDTO($user);

        return new FindUserByNameQueryResult($dto, $user->getUlid());
    }
}

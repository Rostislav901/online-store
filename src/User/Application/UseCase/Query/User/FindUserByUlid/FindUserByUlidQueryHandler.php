<?php

namespace App\User\Application\UseCase\Query\User\FindUserByUlid;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\User\Application\DTO\UserDTOTransformer;
use App\User\Domain\Repository\UserRepositoryInterface;

class FindUserByUlidQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly UserDTOTransformer $transformer)
    {
    }

    public function __invoke(FindUserByUlidQuery $query): FindUserByUlidQueryResult
    {
        $ulid = $query->ulid;

        $userEntity = $this->userRepository->findOneByUlid($ulid);

        $dto = $this->transformer->fromEntityToDTO($userEntity);

        return new FindUserByUlidQueryResult($dto);
    }
}

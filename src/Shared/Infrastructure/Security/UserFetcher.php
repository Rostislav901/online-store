<?php

namespace App\Shared\Infrastructure\Security;

use App\Shared\Domain\Security\UserAuthInterface;
use App\Shared\Domain\Security\UserFetcherInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Webmozart\Assert\Assert;

class UserFetcher implements UserFetcherInterface
{
    public function __construct(private readonly Security $security)
    {
    }

    public function getUserAuth(): UserAuthInterface
    {
        /**
         * @var UserAuthInterface $user
         */
        $user = $this->security->getUser();

        Assert::notNull($user, 'User not found');
        Assert::isInstanceOf($user, UserAuthInterface::class, 'Type Not instance ');

        return $user;
    }
}

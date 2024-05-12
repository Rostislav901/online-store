<?php

namespace App\User\Domain\Aggregate\User\Entity;

use Gesdinet\JWTRefreshTokenBundle\Model\AbstractRefreshToken;
use Gesdinet\JWTRefreshTokenBundle\Model\RefreshTokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class RefreshToken extends AbstractRefreshToken
{
    protected $id;
    private UserInterface $user;
    private \DateTimeInterface $createdAt;
    protected $refreshToken;
    protected $username;
    protected $valid;

    public function setUser(UserInterface $user): void
    {
        $this->user = $user;
    }

    public function setCreatedAtValue(): void
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public static function createForUserWithTtl(string $refreshToken, UserInterface $user, int $ttl): RefreshTokenInterface
    {
        /**
         * @var self $entity
         */
        $entity = parent::createForUserWithTtl($refreshToken, $user, $ttl);
        $entity->setUser($user);

        return $entity;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getValid()
    {
        return $this->valid;
    }
}

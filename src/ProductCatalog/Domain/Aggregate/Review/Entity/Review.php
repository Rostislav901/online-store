<?php

namespace App\ProductCatalog\Domain\Aggregate\Review\Entity;

use App\ProductCatalog\Domain\Aggregate\Review\Specification\ReviewSpecification;
use App\Shared\Domain\Service\UlidGenerator;
use App\Shared\Domain\VO\ProductUlid;
use App\Shared\Domain\VO\UserUlid;

class Review
{
    private string $ulid;
    private ProductUlid $product_ulid;
    private UserUlid $user_ulid;
    private string $text;
    private int $rating;
    private \DateTimeImmutable $createdAt;
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct(
        ProductUlid $product_ulid,
        UserUlid $user_ulid, string $text,
        int $rating, ReviewSpecification $specification)
    {
        $specification->getReviewTargetSpecification()
            ->targetValid($product_ulid->getUlid(), $user_ulid->getUlid());

        $this->ulid = UlidGenerator::generate();
        $this->product_ulid = $product_ulid;
        $this->user_ulid = $user_ulid;
        $this->text = $text;
        $this->rating = $rating;
    }

    public function getProductUlid(): ProductUlid
    {
        return $this->product_ulid;
    }

    public function setProductUlid(ProductUlid $product_ulid): self
    {
        $this->product_ulid = $product_ulid;

        return $this;
    }

    public function getUserUlid(): UserUlid
    {
        return $this->user_ulid;
    }

    public function setUserUlid(UserUlid $user_ulid): self
    {
        $this->user_ulid = $user_ulid;

        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAtValue(): void
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAtValue(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }
}

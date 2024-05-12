<?php

namespace App\ProductCatalog\Domain\Aggregate\Product\Entity;

use App\ProductCatalog\Domain\Aggregate\Product\Enum\Currency;
use App\ProductCatalog\Domain\Aggregate\Product\Specification\ProductSpecification;
use App\ProductCatalog\Domain\VO\DiscountUlid;
use App\Shared\Domain\Service\UlidGenerator;
use App\Shared\Domain\VO\UserUlid;
use Doctrine\Common\Collections\Collection;

class Product
{
    private string $ulid;
    private string $name;
    private string $description;
    private float $price;
    private Currency $currency;
    private int $stock;
    private bool $isActive;
    private \DateTimeImmutable $createdAt;
    private ?\DateTimeImmutable $updatedAt = null;

    private Collection $characteristics;
    private Collection $images;
    private int $category_id;
    private UserUlid $user_ulid;
    private ?DiscountUlid $discount_ulid = null;

    public function __construct(
        string $name, string $description,
        float $price, Currency $currency,
        int $stock, bool $isActive,
        int $category_id, UserUlid $user_ulid,
        private readonly ProductSpecification $specification,
        ?DiscountUlid $discount_ulid = null)
    {
        $this->ulid = UlidGenerator::generate();
        $this->description = $description;
        $this->price = $price;
        $this->currency = $currency;
        $this->stock = $stock;
        $this->isActive = $isActive;
        $this->category_id = $category_id;
        $this->user_ulid = $user_ulid;
        $this->discount_ulid = $discount_ulid;
        $this->setName($name);
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->specification->getNameSpecification()
            ->productNameInUserProductsIsUnique($name, $this->user_ulid->getUlid());
        $this->name = $name;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function setCurrency(Currency $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
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

    /**
     * @return Collection<Characteristic>
     */
    public function getCharacteristics(): Collection
    {
        return $this->characteristics;
    }

    public function setCharacteristics(Collection $characteristics): self
    {
        $this->characteristics = $characteristics;

        return $this;
    }

    /**
     * @return Collection<Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function setImages(Collection $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    public function setCategoryId(int $category_id): self
    {
        $this->category_id = $category_id;

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

    public function getDiscountUlid(): ?DiscountUlid
    {
        return $this->discount_ulid;
    }

    public function setDiscountUlid(?DiscountUlid $discount_ulid): self
    {
        $this->discount_ulid = $discount_ulid;

        return $this;
    }
}

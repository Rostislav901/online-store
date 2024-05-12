<?php

namespace App\Shared\Domain\VO;

use App\Shared\Domain\Specification\UlidSpecification;

trait UlidTrait
{
    private readonly ?string $ulid;

    public function __construct(
        ?string $ulid,
        private readonly ?UlidSpecification $ulidSpecification)
    {
        $this->ulid = $this->ulid($ulid);
    }

    public function ulid(string $ulid): string
    {
        $this->ulidSpecification->satisfy($ulid);

        return $ulid;
    }

    public function getUlid(): ?string
    {
        return $this->ulid;
    }
}

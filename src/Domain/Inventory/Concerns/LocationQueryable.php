<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Concerns;

trait LocationQueryable
{
    /** @var array */
    private $locationQueryableParameters = [];

    /** @var string */
    private $locationId;


    public function withLocationId($id = null): self
    {
        $this->locationId = $id;

        return $this;
    }

    public function getLocationId(): string
    {
        return $this->locationId;
    }

    public function hasLocationId(): bool
    {
        return filled($this->locationId);
    }

    public function getLocationQueryableParameters(): array
    {
        return array_filter($this->locationQueryableParameters);
    }
}

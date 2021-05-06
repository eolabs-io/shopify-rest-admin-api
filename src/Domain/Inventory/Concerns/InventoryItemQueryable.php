<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Concerns;

trait InventoryItemQueryable
{
    /** @var array */
    private $inventoryItemQueryableParameters = [
        'ids' => null,
        'limit' => null,
    ];

    /** @var string */
    private $inventoryItemId;


    public function withInventoryItemId($id = null): self
    {
        $this->inventoryItemId = $id;

        return $this;
    }

    public function getInventoryItemId(): string
    {
        return $this->inventoryItemId;
    }

    public function hasInventoryItemId(): bool
    {
        return filled($this->inventoryItemId);
    }

    public function withInventoryItemIds($ids = null): self
    {
        $this->inventoryItemQueryableParameters['ids'] = (is_array($ids))
            ? implode(',', $ids)
            : null;

        return $this;
    }

    public function withLimit($limit = null): self
    {
        if ($limit > 250) {
            $limit = 250;
        }

        $this->inventoryItemQueryableParameters['limit'] = $limit;

        return $this;
    }

    public function getInventoryItemQueryableParameters(): array
    {
        return array_filter($this->inventoryItemQueryableParameters);
    }
}

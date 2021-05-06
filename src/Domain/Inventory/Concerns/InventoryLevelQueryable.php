<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Concerns;

use Illuminate\Support\Carbon;

trait InventoryLevelQueryable
{
    /** @var array */
    private $inventoryLevelQueryableParameters = [
        'inventory_item_ids' => null,
        'location_ids' => null,
        'limit' => null,
        'updated_at_min' => null,
    ];

    public function withInventoryItemIds($ids = null): self
    {
        $this->inventoryLevelQueryableParameters['inventory_item_ids'] = (is_array($ids))
            ? implode(',', $ids)
            : null;

        return $this;
    }

    public function withLocationIds($ids = null): self
    {
        $this->inventoryLevelQueryableParameters['location_ids'] = (is_array($ids))
            ? implode(',', $ids)
            : null;

        return $this;
    }

    public function withLimit($limit = null): self
    {
        if ($limit > 250) {
            $limit = 250;
        }

        $this->inventoryLevelQueryableParameters['limit'] = $limit;

        return $this;
    }

    public function withUpdatedAtMin(Carbon $date = null): self
    {
        $this->inventoryLevelQueryableParameters['updated_at_min'] = optional($date)->toIso8601String();

        return $this;
    }

    public function getInventoryLevelQueryableParameters(): array
    {
        return array_filter($this->inventoryLevelQueryableParameters);
    }
}

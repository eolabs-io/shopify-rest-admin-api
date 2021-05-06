<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Inventory;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\ShopifyCore;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Concerns\InventoryItemQueryable;

class InventoryItem extends ShopifyCore
{
    use InventoryItemQueryable;

    public function fetch()
    {
        if ($this->hasInventoryItemId()) {
            // A InventoryItem
            $id = $this->getInventoryItemId();
            $endpoint = "/inventory_items/{$id}.json";
            $parameters = $this->getInventoryItemQueryableParameters();
        } else {
            // Displays a list of all InventoryItems by using query parameters
            $endpoint = '/inventory_items.json';
            $parameters = $this->getInventoryItemQueryableParameters();
        }

        return $this->get($endpoint, $parameters);
    }
}

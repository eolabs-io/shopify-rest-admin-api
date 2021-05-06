<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Inventory;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\ShopifyCore;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Concerns\InventoryLevelQueryable;

class InventoryLevel extends ShopifyCore
{
    use InventoryLevelQueryable;

    public function fetch()
    {
        // Displays a list of all Inventory Levels by using query parameters
        $endpoint = '/inventory_levels.json';
        $parameters = $this->getInventoryLevelQueryableParameters();

        return $this->get($endpoint, $parameters);
    }
}

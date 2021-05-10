<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Listeners;

use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Events\FetchInventoryLevel;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Jobs\PerformFetchInventoryLevel;

class FetchInventoryLevelListener
{
    public function handle(FetchInventoryLevel $event)
    {
        $inventoryLevel = $event->inventoryLevel;
        PerformFetchInventoryLevel::dispatch($inventoryLevel)->onQueue('shopify-rest-admin-api');
    }
}

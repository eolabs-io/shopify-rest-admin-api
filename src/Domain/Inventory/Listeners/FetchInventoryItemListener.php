<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Listeners;

use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Events\FetchInventoryItem;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Jobs\PerformFetchInventoryItem;

class FetchInventoryItemListener
{
    public function handle(FetchInventoryItem $event)
    {
        $inventoryItem = $event->inventoryItem;
        PerformFetchInventoryItem::dispatch($inventoryItem)->onQueue('shopify-rest-admin-api');
    }
}

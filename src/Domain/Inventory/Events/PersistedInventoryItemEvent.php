<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Models\InventoryItem;

class PersistedInventoryItemEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Models\InventoryItem */
    public $inventoryItem;

    public function __construct(InventoryItem $inventoryItem)
    {
        $this->inventoryItem = $inventoryItem;
    }
}

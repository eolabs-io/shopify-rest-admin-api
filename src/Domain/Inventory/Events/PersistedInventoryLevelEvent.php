<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Models\InventoryLevel;

class PersistedInventoryLevelEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Models\InventoryLevel */
    public $inventoryLevel;

    public function __construct(InventoryLevel $inventoryLevel)
    {
        $this->inventoryLevel = $inventoryLevel;
    }
}

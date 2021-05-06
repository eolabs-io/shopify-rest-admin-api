<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\InventoryLevel;

class FetchInventoryLevel
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\ShopifyRestAdminApi\Domain\Inventory\InventoryLevel */
    public $inventoryLevel;

    public function __construct(InventoryLevel $inventoryLevel)
    {
        $this->inventoryLevel = $inventoryLevel;
    }
}

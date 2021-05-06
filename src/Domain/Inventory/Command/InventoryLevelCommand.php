<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Command;

use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\InventoryLevel;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Events\FetchInventoryLevel;

class InventoryLevelCommand extends Command
{
    protected $signature = 'shopifyApi:inventory-level
                            {--inventory-item-ids=* : Return only Inventory Levels specified by list of Item IDs.}
                            {--location-ids=* : Return only Inventory Levels specified by list of Location IDs.}
                            {--limit= : Return up to this many results per page.}
                            {--updated-at-min= : Return only Inventory after this date.}';

    protected $description = 'Gets Inventory Levels from Shopify';


    public function handle()
    {
        $this->info('Getting Inventory Levels from Shopify...');

        $inventoryLevel = new InventoryLevel;

        $inventoryLevel = $this->applyOptions($inventoryLevel);

        FetchInventoryLevel::dispatch($inventoryLevel);
    }

    public function applyOptions(InventoryLevel $inventoryLevel): InventoryLevel
    {
        // Apply options
        if ($ids = $this->option('inventory-item-ids')) {
            $inventoryLevel->withInventoryItemIds($ids);
        }

        if ($ids = $this->option('location-ids')) {
            $inventoryLevel->withLocationIds($ids);
        }

        if ($limit = $this->option('limit')) {
            $inventoryLevel->withLimit($limit);
        }

        if ($date = $this->option('updated-at-min')) {
            $inventoryLevel->withUpdatedAtMin(Carbon::create($date));
        }

        return $inventoryLevel;
    }
}

<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Command;

use Illuminate\Console\Command;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\InventoryItem;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Events\FetchInventoryItem;

class InventoryItemCommand extends Command
{
    protected $signature = 'shopifyApi:inventory-item
                            {--ids=* : Return only Inventory Items specified by list of IDs.}
                            {--limit= : Return up to this many results per page.}';

    protected $description = 'Gets Inventory Items from Shopify';


    public function handle()
    {
        $this->info('Getting InventorycItems from Shopify...');

        $inventoryItem = new InventoryItem;

        $inventoryItem = $this->applyOptions($inventoryItem);

        FetchInventoryItem::dispatch($inventoryItem);
    }

    public function applyOptions(InventoryItem $inventoryItem): InventoryItem
    {
        // Apply options
        if ($ids = $this->option('ids')) {
            $inventoryItem->withInventoryItemIds($ids);
        }

        if ($limit = $this->option('limit')) {
            $inventoryItem->withLimit($limit);
        }

        return $inventoryItem;
    }
}

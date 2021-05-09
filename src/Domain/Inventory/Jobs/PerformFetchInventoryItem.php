<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\RequestException;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\InventoryItem;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Events\FetchInventoryItem;
use EolabsIo\ShopifyRestAdminApi\Support\Facades\ShopifyThrottlingMiddleware;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Jobs\ProcessFetchInventoryItemResponse;

class PerformFetchInventoryItem implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /** @var EolabsIo\ShopifyRestAdminApi\Domain\Inventory\InventoryItem */
    public $inventoryItem;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(InventoryItem $inventoryItem)
    {
        $this->inventoryItem = $inventoryItem;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $results = $this->inventoryItem->fetch();

            ProcessFetchInventoryItemResponse::dispatch($results);
            FetchInventoryItem::dispatchIf($this->inventoryItem->hasNextPage(), $this->inventoryItem);
        } catch (RequestException $exception) {
            // $delay = 30;
            // $this->handleRequestException($exception, $delay);
        }
    }

    public function middleware()
    {
        return [ShopifyThrottlingMiddleware::forShopify()];
    }
}

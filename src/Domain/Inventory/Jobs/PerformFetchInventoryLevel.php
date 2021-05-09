<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\RequestException;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\InventoryLevel;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Events\FetchInventoryLevel;
use EolabsIo\ShopifyRestAdminApi\Support\Facades\ShopifyThrottlingMiddleware;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Jobs\ProcessFetchInventoryLevelResponse;

class PerformFetchInventoryLevel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /** @var EolabsIo\ShopifyRestAdminApi\Domain\Inventory\InventoryLevel */
    public $inventoryLevel;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(InventoryLevel $inventoryLevel)
    {
        $this->inventoryLevel = $inventoryLevel;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $results = $this->inventoryLevel->fetch();

            ProcessFetchInventoryLevelResponse::dispatch($results);
            FetchInventoryLevel::dispatchIf($this->inventoryLevel->hasNextPage(), $this->inventoryLevel);
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

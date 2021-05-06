<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Feature\Inventory;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\ShopifyRestAdminApi\Tests\TestCase;
use EolabsIo\ShopifyRestAdminApi\Support\Facades\InventoryItem;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Jobs\PerformFetchInventoryItem;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Jobs\ProcessFetchInventoryItemResponse;

class PerformFetchInventoryItemTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
        Event::fake();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /** @test */
    public function it_calls_the_correct_job()
    {
        InventoryItem::fake();

        PerformFetchInventoryItem::dispatch(InventoryItem::withLimit());

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchInventoryItem::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessFetchInventoryItemResponse::class, function ($job) {
            return data_get($job->results, 'inventory_items.0.id') === 39072856;
        });
    }
}

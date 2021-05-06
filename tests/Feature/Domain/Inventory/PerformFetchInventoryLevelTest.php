<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Feature\Inventory;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\ShopifyRestAdminApi\Tests\TestCase;
use EolabsIo\ShopifyRestAdminApi\Support\Facades\InventoryLevel;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Jobs\PerformFetchInventoryLevel;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Jobs\ProcessFetchInventoryLevelResponse;

class PerformFetchInventoryLevelTest extends TestCase
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
        InventoryLevel::fake();

        PerformFetchInventoryLevel::dispatch(InventoryLevel::withLimit());

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchInventoryLevel::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessFetchInventoryLevelResponse::class, function ($job) {
            return data_get($job->results, 'inventory_levels.0.inventory_item_id') === 808950810
                && data_get($job->results, 'inventory_levels.0.location_id') === 487838322;
        });
    }
}

<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Feature\Inventory;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\ShopifyRestAdminApi\Tests\TestCase;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Events\FetchInventoryLevel;

class InventoryLevelCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
        Event::fake();
    }

    /** @test */
    public function it_can_execute_inventory_level_artisan_command()
    {
        $this->artisan('shopifyApi:inventory-level')
             ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchInventoryLevel::class, function ($event) {
            return true;
        });
    }
}

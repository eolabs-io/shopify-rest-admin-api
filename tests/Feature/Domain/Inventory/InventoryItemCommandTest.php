<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Feature\Inventory;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\ShopifyRestAdminApi\Tests\TestCase;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Events\FetchInventoryItem;

class InventoryItemCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
        Event::fake();
    }

    /** @test */
    public function it_can_execute_inventory_item_artisan_command()
    {
        $this->artisan('shopifyApi:inventory-item')
             ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchInventoryItem::class, function ($event) {
            return true;
        });
    }
}

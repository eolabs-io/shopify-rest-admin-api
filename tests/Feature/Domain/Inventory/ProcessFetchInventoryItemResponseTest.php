<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Feature\Inventory;

use EolabsIo\ShopifyRestAdminApi\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\ShopifyRestAdminApi\Support\Facades\InventoryItem;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Models\InventoryItem as InventoryItemModel;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Jobs\ProcessFetchInventoryItemResponse;

class ProcessFetchInventoryItemResponseTest extends TestCase
{
    use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();

        InventoryItem::fake();

        $results = InventoryItem::fetch();

        (new ProcessFetchInventoryItemResponse($results))->handle();
    }

    /** @test */
    public function it_can_process_inventoryItem_response()
    {
        $inventoryItem = InventoryItemModel::find(39072856);

        $this->assertEquals(39072856, $inventoryItem->id);
        $this->assertEquals('IPOD2008GREEN', $inventoryItem->sku);
        $this->assertEquals('Thu Apr 01 2021 14:26:30 GMT+0000', $inventoryItem->created_at->toString());
        $this->assertEquals('Thu Apr 01 2021 14:26:30 GMT+0000', $inventoryItem->updated_at->toString());
        $this->assertTrue($inventoryItem->requires_shipping);
        $this->assertEquals(25.00, $inventoryItem->cost);
    }
}

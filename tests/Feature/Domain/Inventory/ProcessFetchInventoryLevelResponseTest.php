<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Feature\Inventory;

use EolabsIo\ShopifyRestAdminApi\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\ShopifyRestAdminApi\Support\Facades\InventoryLevel;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Models\InventoryLevel as InventoryLevelModel;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Jobs\ProcessFetchInventoryLevelResponse;

class ProcessFetchInventoryLevelResponseTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        InventoryLevel::fake();

        $results = InventoryLevel::fetch();

        (new ProcessFetchInventoryLevelResponse($results))->handle();
    }

    /** @test */
    public function it_can_process_inventoryLevel_response()
    {
        $inventoryLevel = InventoryLevelModel::first();

        $this->assertEquals(808950810, $inventoryLevel->inventory_item_id);
        $this->assertEquals(487838322, $inventoryLevel->location_id);
        $this->assertEquals(9, $inventoryLevel->available);
        $this->assertEquals('Thu Apr 01 2021 15:57:26 GMT+0000', $inventoryLevel->updated_at->toString());
        $this->assertEquals('gid://shopify/InventoryLevel/690933842?inventory_item_id=808950810', $inventoryLevel->admin_graphql_api_id);
    }
}

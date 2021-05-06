<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Feature\Domain\Inventory;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use EolabsIo\ShopifyRestAdminApi\Tests\TestCase;
use EolabsIo\ShopifyRestAdminApi\Support\Facades\InventoryLevel;

class InventoryLevelTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    /** @test */
    public function it_sends_the_correct_request_for_inventory_levels_query()
    {
        InventoryLevel::fake();

        $inventoryItemIds = ['1234567', '7654321'];
        $locationIds = ['1', '2'];

        InventoryLevel::withInventoryItemIds($inventoryItemIds)
            ->withLocationIds($locationIds)
            ->fetch();

        Http::assertSent(function ($request) {
            return $request->hasHeader('X-Shopify-Access-Token', '12345') &&
                       $request->hasHeader('Accept', 'application/json') &&
                       $request->url() == 'https://shopify-shop.myshopify.com/admin/api/2021-04/inventory_levels.json?inventory_item_ids=1234567%2C7654321&location_ids=1%2C2';
        });
    }

    /** @test */
    public function it_can_get_a_valid_inventory_Levels_response()
    {
        InventoryLevel::fake();

        $ids = ['1234567', '7654321'];

        $response = InventoryLevel::withInventoryItemIds($ids)->fetch();

        $inventoryLevels = Arr::get($response, 'inventory_levels');

        // InventoryLevels
        $this->assertEquals(808950810, Arr::get($inventoryLevels, '0.inventory_item_id'));
        $this->assertEquals(487838322, Arr::get($inventoryLevels, '0.location_id'));
        $this->assertEquals(9, Arr::get($inventoryLevels, '0.available'));
    }
}

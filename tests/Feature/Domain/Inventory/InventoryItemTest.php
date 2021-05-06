<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Feature\Domain\Inventory;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use EolabsIo\ShopifyRestAdminApi\Tests\TestCase;
use EolabsIo\ShopifyRestAdminApi\Support\Facades\InventoryItem;

class InventoryItemTest extends TestCase
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
    public function it_sends_the_correct_request_for_inventory_item_query()
    {
        InventoryItem::fake([
            'type' => '__InventoryItem__',
        ]);

        $id = '1234567';

        InventoryItem::withInventoryItemId($id)
            ->fetch();

        Http::assertSent(function ($request) use ($id) {
            return $request->hasHeader('X-Shopify-Access-Token', '12345') &&
                   $request->hasHeader('Accept', 'application/json') &&
                   $request->url() == "https://shopify-shop.myshopify.com/admin/api/2021-04/inventory_items/{$id}.json";
        });
    }

    /** @test */
    public function it_can_get_a_valid_inventory_item_response()
    {
        InventoryItem::fake([
            'type' => '__InventoryItem__',
        ]);

        $id = '1234567';

        $response = InventoryItem::withInventoryItemId($id)
            ->fetch();

        $inventoryItem = Arr::get($response, 'inventory_item');

        // InventoryItem
        $this->assertEquals(808950810, Arr::get($inventoryItem, 'id'));
        $this->assertEquals('IPOD2008PINK', Arr::get($inventoryItem, 'sku'));
        $this->assertEquals('2021-04-01T14:26:30-04:00', Arr::get($inventoryItem, 'created_at'));
        $this->assertEquals('2021-04-01T14:26:30-04:00', Arr::get($inventoryItem, 'updated_at'));
        $this->assertTrue(Arr::get($inventoryItem, 'requires_shipping'));
        $this->assertEquals(25.00, Arr::get($inventoryItem, 'cost'));
    }


    /** @test */
    public function it_sends_the_correct_request_for_inventory_items_query()
    {
        InventoryItem::fake();

        $ids = ['1234567', '7654321'];

        InventoryItem::withInventoryItemIds($ids)->fetch();

        Http::assertSent(function ($request) {
            return $request->hasHeader('X-Shopify-Access-Token', '12345') &&
                       $request->hasHeader('Accept', 'application/json') &&
                       $request->url() == 'https://shopify-shop.myshopify.com/admin/api/2021-04/inventory_items.json?ids=1234567%2C7654321';
        });
    }

    /** @test */
    public function it_can_get_a_valid_inventory_items_response()
    {
        InventoryItem::fake();

        $ids = ['1234567', '7654321'];

        $response = InventoryItem::withInventoryItemIds($ids)->fetch();

        $inventoryItems = Arr::get($response, 'inventory_items');

        // InventoryItems
        $this->assertEquals(39072856, Arr::get($inventoryItems, '0.id'));
        $this->assertEquals('IPOD2008GREEN', Arr::get($inventoryItems, '0.sku'));
        $this->assertEquals('2021-04-01T14:26:30-04:00', Arr::get($inventoryItems, '0.created_at'));
        $this->assertEquals('2021-04-01T14:26:30-04:00', Arr::get($inventoryItems, '0.updated_at'));
        $this->assertTrue(Arr::get($inventoryItems, '0.requires_shipping'));
        $this->assertEquals(25.00, Arr::get($inventoryItems, '0.cost'));
    }
}

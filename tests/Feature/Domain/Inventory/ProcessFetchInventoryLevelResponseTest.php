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

    public $results;

    protected function setUp(): void
    {
        parent::setUp();

        InventoryLevel::fake();

        $this->results = InventoryLevel::fetch();

        (new ProcessFetchInventoryLevelResponse($this->results))->handle();
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

    /** @test */
    public function it_can_process_same_inventoryLevel_without_duplication_response()
    {
        $this->assertinventoryLevelDataBaseState();

        // Same repsonse as before processed a second time
        (new ProcessFetchInventoryLevelResponse($this->results))->handle();

        $this->assertinventoryLevelDataBaseState();
    }

    public function assertinventoryLevelDataBaseState()
    {
        $this->assertDatabaseCount('locations', 0);
        $this->assertDatabaseCount('inventory_items', 0);
        $this->assertDatabaseCount('inventory_levels', 2);
        $this->assertDatabaseCount('products', 0);
        $this->assertDatabaseCount('prices', 0);
        $this->assertDatabaseCount('product_images', 0);
        $this->assertDatabaseCount('product_variants', 0);
        $this->assertDatabaseCount('product_options', 0);
        $this->assertDatabaseCount('product_option_values', 0);
        $this->assertDatabaseCount('presentment_prices', 0);
        $this->assertDatabaseCount('addresses', 0);
        $this->assertDatabaseCount('billing_addresses', 0);
        $this->assertDatabaseCount('shipping_addresses', 0);
        $this->assertDatabaseCount('customers', 0);
        $this->assertDatabaseCount('tax_exemptions', 0);
        $this->assertDatabaseCount('customer_tax_exemption', 0);
        $this->assertDatabaseCount('money', 0);
        $this->assertDatabaseCount('payment_details', 0);
        $this->assertDatabaseCount('client_details', 0);
        $this->assertDatabaseCount('orders', 0);
        $this->assertDatabaseCount('discount_applications', 0);
        $this->assertDatabaseCount('discount_codes', 0);
        $this->assertDatabaseCount('note_attributes', 0);
        $this->assertDatabaseCount('payment_gateway_names', 0);
        $this->assertDatabaseCount('tax_lines', 0);
        $this->assertDatabaseCount('line_items', 0);
        $this->assertDatabaseCount('discount_allocations', 0);
        $this->assertDatabaseCount('duties', 0);
        $this->assertDatabaseCount('duty_tax_line', 0);
        $this->assertDatabaseCount('properties', 0);
        $this->assertDatabaseCount('line_item_tax_line', 0);
        $this->assertDatabaseCount('receipts', 0);
        $this->assertDatabaseCount('fulfillments', 0);
        $this->assertDatabaseCount('fulfillment_line_item', 0);
        $this->assertDatabaseCount('tracking_numbers', 0);
        $this->assertDatabaseCount('tracking_urls', 0);
        $this->assertDatabaseCount('refunds', 0);
        $this->assertDatabaseCount('refund_duties', 0);
        $this->assertDatabaseCount('refund_line_items', 0);
        $this->assertDatabaseCount('order_adjustments', 0);
        $this->assertDatabaseCount('currency_exchange_adjustments', 0);
        $this->assertDatabaseCount('transactions', 0);
        $this->assertDatabaseCount('duty_refund', 0);
        $this->assertDatabaseCount('refund_transaction', 0);
        $this->assertDatabaseCount('shipping_lines', 0);
        $this->assertDatabaseCount('order_tax_line', 0);
    }
}

<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Feature\Inventory;

use EolabsIo\ShopifyRestAdminApi\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Jobs\ProcessFetchLocationResponse;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Models\Location as LocationModel;
use EolabsIo\ShopifyRestAdminApi\Support\Facades\Location;

class ProcessFetchLocationResponseTest extends TestCase
{
    use RefreshDatabase;

    public $results;

    protected function setUp(): void
    {
        parent::setUp();

        Location::fake();

        $this->results = Location::fetch();

        (new ProcessFetchLocationResponse($this->results))->handle();
    }

    /** @test */
    public function it_can_process_location_response()
    {
        $location = LocationModel::find(905684977);

        $this->assertEquals(905684977, $location->id);
        $this->assertEquals('50 Rideau Street', $location->name);
        $this->assertEquals('50 Rideau Street', $location->address1);
        $this->assertNull($location->address2);
        $this->assertEquals('Ottawa', $location->city);
        $this->assertEquals('Ontario', $location->province);
        $this->assertEquals('K1N 9J7', $location->zip);
    }

    /** @test */
    public function it_can_process_same_location_without_duplication_response()
    {
        $this->assertLocationDataBaseState();

        // Same repsonse as before processed a second time
        (new ProcessFetchLocationResponse($this->results))->handle();

        $this->assertLocationDataBaseState();
    }

    public function assertLocationDataBaseState()
    {
        $this->assertDatabaseCount('locations', 5);
        $this->assertDatabaseCount('inventory_items', 0);
        $this->assertDatabaseCount('inventory_levels', 0);
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

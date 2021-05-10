<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Feature\Customers;

use Illuminate\Support\Arr;
use EolabsIo\ShopifyRestAdminApi\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\ShopifyRestAdminApi\Support\Facades\Customer;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Models\Customer as CustomerModel;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Jobs\ProcessFetchCustomerResponse;

class ProcessFetchCustomerResponseTest extends TestCase
{
    use RefreshDatabase;

    public $results;

    protected function setUp(): void
    {
        parent::setUp();

        Customer::fake();

        $this->results = Customer::fetch();

        (new ProcessFetchCustomerResponse($this->results))->handle();
    }

    /** @test */
    public function it_can_process_customers_response()
    {
        $customer = CustomerModel::with([
                'defaultAddress',
                'taxExemptions',
                'addresses',
            ])->first();

        $this->assertEquals(207119551, $customer->id);
        $this->assertEquals('bob.norman@hostmail.com', $customer->email);
        $this->assertFalse($customer->accepts_marketing);

        // defaultAddress
        $defaultAddress = $customer->defaultAddress;

        $this->assertEquals(207119551, $defaultAddress->id);
        $this->assertNull($defaultAddress->first_name);
        $this->assertNull($defaultAddress->last_name);
        $this->assertNull($defaultAddress->company);
        $this->assertEquals('Chestnut Street 92', $defaultAddress->address1);

        // taxExemptions
        $taxExemptions = Arr::pluck($customer->taxExemptions->toArray(), 'name');

        $this->assertEquals([
            "CA_STATUS_CARD_EXEMPTION",
            "CA_BC_RESELLER_EXEMPTION",
        ], $taxExemptions);
    }

    /** @test */
    public function it_can_process_same_customers_without_duplication_response()
    {
        $this->assertCustomersDataBaseState();

        // Same repsonse as before processed a second time
        (new ProcessFetchCustomerResponse($this->results))->handle();

        $this->assertCustomersDataBaseState();
    }

    public function assertCustomersDataBaseState()
    {
        $this->assertDatabaseCount('locations', 0);
        $this->assertDatabaseCount('inventory_items', 0);
        $this->assertDatabaseCount('inventory_levels', 0);
        $this->assertDatabaseCount('products', 0);
        $this->assertDatabaseCount('prices', 0);
        $this->assertDatabaseCount('product_images', 0);
        $this->assertDatabaseCount('product_variants', 0);
        $this->assertDatabaseCount('product_options', 0);
        $this->assertDatabaseCount('product_option_values', 0);
        $this->assertDatabaseCount('presentment_prices', 0);
        $this->assertDatabaseCount('addresses', 1);
        $this->assertDatabaseCount('billing_addresses', 0);
        $this->assertDatabaseCount('shipping_addresses', 0);
        $this->assertDatabaseCount('customers', 1);
        $this->assertDatabaseCount('tax_exemptions', 2);
        $this->assertDatabaseCount('customer_tax_exemption', 2);
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

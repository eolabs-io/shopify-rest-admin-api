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


    protected function setUp(): void
    {
        parent::setUp();

        Customer::fake();

        $results = Customer::fetch();

        (new ProcessFetchCustomerResponse($results))->handle();
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
}

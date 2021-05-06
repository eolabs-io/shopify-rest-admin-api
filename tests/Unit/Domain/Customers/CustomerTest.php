<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Customers;

use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Models\Address;
use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Models\Customer;

class CustomerTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Customer::class;
    }

    /** @test */
    public function it_has_default_address_relationship()
    {
        $customer = Customer::factory()->create();
        $address = Address::factory()->create(['customer_id' => $customer->id]);
        $customer->default_address_id = $address->id;
        $customer->save();

        $this->assertDatabaseCount('addresses', 1);
        $this->assertEquals(1, Customer::first()->defaultAddress()->count());
    }

    /** @test */
    public function it_has_tax_exemptions_relationship()
    {
        Customer::factory()->hasTaxExemptions()->create();

        $this->assertDatabaseCount('tax_exemptions', 1);
        $this->assertEquals(1, Customer::first()->taxExemptions()->count());
    }
}

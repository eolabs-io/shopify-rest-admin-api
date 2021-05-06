<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Feature\Customers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use EolabsIo\ShopifyRestAdminApi\Tests\TestCase;
use EolabsIo\ShopifyRestAdminApi\Support\Facades\Customer;

class CustomersTest extends TestCase
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
    public function it_sends_the_correct_request_for_customer_query()
    {
        Customer::fake([
            'type' => '__Customer__',
        ]);

        $id = '1234567';

        Customer::withCustomerId($id)
            ->fetch();

        Http::assertSent(function ($request) use ($id) {
            return $request->hasHeader('X-Shopify-Access-Token', '12345') &&
                   $request->hasHeader('Accept', 'application/json') &&
                   $request->url() == "https://shopify-shop.myshopify.com/admin/api/2021-04/customers/{$id}.json";
        });
    }

    /** @test */
    public function it_can_get_a_valid_customer_response()
    {
        Customer::fake([
            'type' => '__Customer__',
        ]);

        $id = '1234567';

        $response = Customer::withCustomerId($id)
            ->fetch();

        $customer = Arr::get($response, 'customer');

        // Customer
        $this->assertEquals(207119551, Arr::get($customer, 'id'));
        $this->assertEquals('bob.norman@hostmail.com', Arr::get($customer, 'email'));
        $this->assertEquals('2021-04-01T17:29:56-04:00', Arr::get($customer, 'created_at'));
    }


    /** @test */
    public function it_sends_the_correct_request_for_customers_query()
    {
        Customer::fake();

        Customer::fetch();

        Http::assertSent(function ($request) {
            return $request->hasHeader('X-Shopify-Access-Token', '12345') &&
                       $request->hasHeader('Accept', 'application/json') &&
                       $request->url() == 'https://shopify-shop.myshopify.com/admin/api/2021-04/customers.json';
        });
    }

    /** @test */
    public function it_can_get_a_valid_customers_response()
    {
        Customer::fake();

        $response = Customer::fetch();

        $customers = Arr::get($response, 'customers');

        // Order
        $this->assertEquals(207119551, Arr::get($customers, '0.id'));
        $this->assertEquals('bob.norman@hostmail.com', Arr::get($customers, '0.email'));
        $this->assertEquals('2021-04-01T17:24:20-04:00', Arr::get($customers, '0.created_at'));
    }

    /** @test */
    public function it_can_get_customers_with_pagination()
    {
        Customer::fake([
            'type' => '__CustomerWithPagination__',
        ]);

        $customers = Customer::withlimit(10);
        $response = $customers->fetch();

        $this->assertTrue($customers->hasNextPage());

        $nextPageResponse = $customers->fetch();

        $this->assertArrayHasKey('customers', $response->toArray());
        $this->assertArrayHasKey('customers', $nextPageResponse->toArray());

        $customerId = data_get($response, 'customers.0.id');
        $customerId2 = data_get($nextPageResponse, 'customers.0.id');

        $this->assertEquals('207119551', $customerId);
        $this->assertEquals('440795512387', $customerId2);

        // $this->assertSentOrders();
        // $this->assertSentOrdersByNextCursor();
    }

    /** @test */
    public function it_sends_the_correct_request_for_customer_count_query()
    {
        Customer::fake([
            'type' => '__CustomerCount__',
        ]);

        Customer::count();

        Http::assertSent(function ($request) {
            return $request->hasHeader('X-Shopify-Access-Token', '12345') &&
                           $request->hasHeader('Accept', 'application/json') &&
                           $request->url() == 'https://shopify-shop.myshopify.com/admin/api/2021-04/customers/count.json';
        });
    }

    /** @test */
    public function it_can_get_a_valid_customer_count_response()
    {
        Customer::fake([
            'type' => '__CustomerCount__',
        ]);

        $response = Customer::count();

        $count = Arr::get($response, 'count');

        // Order Count
        $this->assertEquals('1', $count);
    }
}

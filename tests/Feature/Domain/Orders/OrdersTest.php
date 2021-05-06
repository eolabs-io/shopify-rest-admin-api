<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Feature\Domain\Orders;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use EolabsIo\ShopifyRestAdminApi\Tests\TestCase;
use EolabsIo\ShopifyRestAdminApi\Support\Facades\Order;

class OrdersTest extends TestCase
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
    public function it_sends_the_correct_request_for_order_query()
    {
        Order::fake([
            'type' => '__Order__',
        ]);

        $id = '1234567';

        Order::withOrderId($id)
            ->fetch();

        Http::assertSent(function ($request) use ($id) {
            return $request->hasHeader('X-Shopify-Access-Token', '12345') &&
                   $request->hasHeader('Accept', 'application/json') &&
                   $request->url() == "https://shopify-shop.myshopify.com/admin/api/2021-04/orders/{$id}.json";
        });
    }

    /** @test */
    public function it_can_get_a_valid_order_response()
    {
        Order::fake([
            'type' => '__Order__',
        ]);

        $id = '1234567';

        $response = Order::withOrderId($id)
            ->fetch();

        $order = Arr::get($response, 'order');

        // Order
        $this->assertEquals('450789469', Arr::get($order, 'id'));
        $this->assertEquals('bob.norman@hostmail.com', Arr::get($order, 'email'));
        $this->assertEquals('598.94', Arr::get($order, 'total_price'));
    }


    /** @test */
    public function it_sends_the_correct_request_for_orders_query()
    {
        Order::fake();

        Order::fetch();

        Http::assertSent(function ($request) {
            return $request->hasHeader('X-Shopify-Access-Token', '12345') &&
                       $request->hasHeader('Accept', 'application/json') &&
                       $request->url() == 'https://shopify-shop.myshopify.com/admin/api/2021-04/orders.json';
        });
    }

    /** @test */
    public function it_can_get_a_valid_orders_response()
    {
        Order::fake();

        $response = Order::fetch();

        $orders = Arr::get($response, 'orders');

        // OIrder
        $this->assertEquals('450789469', Arr::get($orders, '0.id'));
        $this->assertEquals(597.00, Arr::get($orders, '0.subtotal_price'));
        $this->assertEquals('+557734881234', Arr::get($orders, '0.phone'));
    }

    /** @test */
    public function it_sends_the_correct_request_for_order_count_query()
    {
        Order::fake([
            'type' => '__OrderCount__',
        ]);

        Order::count();

        Http::assertSent(function ($request) {
            return $request->hasHeader('X-Shopify-Access-Token', '12345') &&
                           $request->hasHeader('Accept', 'application/json') &&
                           $request->url() == 'https://shopify-shop.myshopify.com/admin/api/2021-04/orders/count.json';
        });
    }

    /** @test */
    public function it_can_get_a_valid_order_count_response()
    {
        Order::fake([
            'type' => '__OrderCount__',
        ]);

        $response = Order::count();

        $count = Arr::get($response, 'count');

        // Order Count
        $this->assertEquals(1, $count);
    }
}

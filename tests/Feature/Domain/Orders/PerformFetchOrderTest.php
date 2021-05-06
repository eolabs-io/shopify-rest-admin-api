<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Feature\Orders;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\ShopifyRestAdminApi\Tests\TestCase;
use EolabsIo\ShopifyRestAdminApi\Support\Facades\Order;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Jobs\PerformFetchOrder;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Jobs\ProcessFetchOrderResponse;

class PerformFetchOrderTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
        Event::fake();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /** @test */
    public function it_calls_the_correct_job()
    {
        Order::fake();

        PerformFetchOrder::dispatch(Order::withLimit());

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchOrder::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessFetchOrderResponse::class, function ($job) {
            return data_get($job->results, 'orders.0.id') === 450789469;
        });
    }
}

<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Feature\Orders;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Events\FetchOrder;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\ShopifyRestAdminApi\Tests\TestCase;

class OrderCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
        Event::fake();
    }

    /** @test */
    public function it_can_execute_order_artisan_command()
    {
        $this->artisan('shopifyApi:order')
             ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchOrder::class, function ($event) {
            return true;
        });
    }
}

<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Feature\Customers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\ShopifyRestAdminApi\Tests\TestCase;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Events\FetchCustomer;

class CustomerCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
        Event::fake();
    }

    /** @test */
    public function it_can_execute_customer_artisan_command()
    {
        $this->artisan('shopifyApi:customer')
             ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchCustomer::class, function ($event) {
            return true;
        });
    }
}

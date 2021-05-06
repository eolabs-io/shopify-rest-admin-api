<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Feature\Products;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\ShopifyRestAdminApi\Tests\TestCase;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Events\FetchProduct;

class ProductCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
        Event::fake();
    }

    /** @test */
    public function it_can_execute_product_artisan_command()
    {
        $this->artisan('shopifyApi:product')
             ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchProduct::class, function ($event) {
            return true;
        });
    }
}

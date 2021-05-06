<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Feature\Inventory;

use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Events\FetchLocation;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\ShopifyRestAdminApi\Tests\TestCase;

class LocationCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
        Event::fake();
    }

    /** @test */
    public function it_can_execute_location_artisan_command()
    {
        $this->artisan('shopifyApi:location')
             ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchLocation::class, function ($event) {
            return true;
        });
    }
}

<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Feature\Inventory;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\ShopifyRestAdminApi\Tests\TestCase;
use EolabsIo\ShopifyRestAdminApi\Support\Facades\Location;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Jobs\PerformFetchLocation;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Jobs\ProcessFetchLocationResponse;

class PerformFetchLocationTest extends TestCase
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
        Location::fake();

        PerformFetchLocation::dispatch(Location::withLocationId());

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchLocation::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessFetchLocationResponse::class, function ($job) {
            return data_get($job->results, 'locations.0.id') === 905684977;
        });
    }
}

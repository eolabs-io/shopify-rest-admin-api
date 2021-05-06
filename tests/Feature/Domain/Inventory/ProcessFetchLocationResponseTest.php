<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Feature\Inventory;

use EolabsIo\ShopifyRestAdminApi\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Jobs\ProcessFetchLocationResponse;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Models\Location as LocationModel;
use EolabsIo\ShopifyRestAdminApi\Support\Facades\Location;

class ProcessFetchLocationResponseTest extends TestCase
{
    use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();

        Location::fake();

        $results = Location::fetch();

        (new ProcessFetchLocationResponse($results))->handle();
    }

    /** @test */
    public function it_can_process_location_response()
    {
        $location = LocationModel::find(905684977);

        $this->assertEquals(905684977, $location->id);
        $this->assertEquals('50 Rideau Street', $location->name);
        $this->assertEquals('50 Rideau Street', $location->address1);
        $this->assertNull($location->address2);
        $this->assertEquals('Ottawa', $location->city);
        $this->assertEquals('Ontario', $location->province);
        $this->assertEquals('K1N 9J7', $location->zip);
    }
}

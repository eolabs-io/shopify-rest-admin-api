<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Feature\Domain\Inventory;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use EolabsIo\ShopifyRestAdminApi\Tests\TestCase;
use EolabsIo\ShopifyRestAdminApi\Support\Facades\Location;

class LocationTest extends TestCase
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
    public function it_sends_the_correct_request_for_location_query()
    {
        Location::fake([
            'type' => '__Location__',
        ]);

        $id = '1234567';

        Location::withLocationId($id)
            ->fetch();

        Http::assertSent(function ($request) use ($id) {
            return $request->hasHeader('X-Shopify-Access-Token', '12345') &&
                   $request->hasHeader('Accept', 'application/json') &&
                   $request->url() == "https://shopify-shop.myshopify.com/admin/api/2021-04/locations/{$id}.json";
        });
    }

    /** @test */
    public function it_can_get_a_valid_location_response()
    {
        Location::fake([
            'type' => '__Location__',
        ]);

        $id = '1234567';

        $response = Location::withLocationId($id)
            ->fetch();

        $location = Arr::get($response, 'location');

        // Location
        $this->assertEquals(487838322, Arr::get($location, 'id'));
        $this->assertEquals('Fifth Avenue AppleStore', Arr::get($location, 'name'));
        $this->assertNull(Arr::get($location, 'address1'));
        $this->assertNull(Arr::get($location, 'address2'));
    }


    /** @test */
    public function it_sends_the_correct_request_for_locations_query()
    {
        Location::fake();

        Location::fetch();

        Http::assertSent(function ($request) {
            return $request->hasHeader('X-Shopify-Access-Token', '12345') &&
                       $request->hasHeader('Accept', 'application/json') &&
                       $request->url() == 'https://shopify-shop.myshopify.com/admin/api/2021-04/locations.json';
        });
    }

    /** @test */
    public function it_can_get_a_valid_locations_response()
    {
        Location::fake();

        $response = Location::fetch();

        $locations = Arr::get($response, 'locations');

        // Locations
        $this->assertEquals(905684977, Arr::get($locations, '0.id'));
        $this->assertEquals('50 Rideau Street', Arr::get($locations, '0.name'));
        $this->assertEquals('50 Rideau Street', Arr::get($locations, '0.address1'));
        $this->assertNull(Arr::get($locations, '0.address2'));
    }

    /** @test */
    public function it_sends_the_correct_request_for_location_count_query()
    {
        Location::fake([
            'type' => '__LocationCount__',
        ]);

        Location::count();

        Http::assertSent(function ($request) {
            return $request->hasHeader('X-Shopify-Access-Token', '12345') &&
                           $request->hasHeader('Accept', 'application/json') &&
                           $request->url() == 'https://shopify-shop.myshopify.com/admin/api/2021-04/locations/count.json';
        });
    }

    /** @test */
    public function it_can_get_a_valid_location_count_response()
    {
        Location::fake([
            'type' => '__LocationCount__',
        ]);

        $response = Location::count();

        $count = Arr::get($response, 'count');

        // Order Count
        $this->assertEquals(5, $count);
    }

    /** @test */
    public function it_sends_the_correct_request_for_location_inventory_levels_query()
    {
        Location::fake([
              'type' => '__InventoryLevels__',
          ]);

        $id = '1234567';

        Location::withLocationId($id)
              ->inventoryLevels();

        Http::assertSent(function ($request) use ($id) {
            return $request->hasHeader('X-Shopify-Access-Token', '12345') &&
                             $request->hasHeader('Accept', 'application/json') &&
                             $request->url() == "https://shopify-shop.myshopify.com/admin/api/2021-04/locations/{$id}/inventory_levels.json";
        });
    }

    /** @test */
    public function it_can_get_a_valid_location_inventory_levels_response()
    {
        Location::fake([
              'type' => '__InventoryLevels__',
          ]);

        $id = '1234567';

        $response = Location::withLocationId($id)
            ->inventoryLevels();

        $inventoryLevels = Arr::get($response, 'inventory_levels');

        $this->assertEquals(808950810, Arr::get($inventoryLevels, '0.inventory_item_id'));
        $this->assertEquals(487838322, Arr::get($inventoryLevels, '0.location_id'));
        $this->assertEquals(9, Arr::get($inventoryLevels, '0.available'));
    }
}

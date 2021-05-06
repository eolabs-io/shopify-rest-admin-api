<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Fakes;

use Illuminate\Support\Facades\Http;

class LocationsFake extends LocationFake
{
    public $endpoint = 'https://shopify-shop.myshopify.com/admin/api/2021-04/locations.json';

    public function fake()
    {
        $locationsResponse = $this->getLocationsResponse();

        Http::fake([
            $this->endpoint => Http::sequence()
                                   ->push($locationsResponse, 200)
                                   ->whenEmpty(Http::response('', 404)),
       ]);
    }

    public function getLocationsResponse(): string
    {
        $file = __DIR__ . '/../Stubs/Responses/Locations.json';
        return file_get_contents($file);
    }
}

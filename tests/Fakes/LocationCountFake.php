<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Fakes;

use Illuminate\Support\Facades\Http;
use EolabsIo\ShopifyRestAdminApi\Tests\Fakes\LocationFake;

class LocationCountFake extends LocationFake
{
    public $endpoint = 'https://shopify-shop.myshopify.com/admin/api/2021-04/locations/count.json';

    public function fake()
    {
        $locationCountResponse = $this->getLocationCountResponse();

        Http::fake([
            $this->endpoint => Http::sequence()
                                   ->push($locationCountResponse, 200)
                                   ->whenEmpty(Http::response('', 404)),
       ]);
    }

    public function getLocationCountResponse(): string
    {
        $file = __DIR__ . '/../Stubs/Responses/locationCount.json';
        return file_get_contents($file);
    }
}

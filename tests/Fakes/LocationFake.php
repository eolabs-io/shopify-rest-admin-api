<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Fakes;

use Illuminate\Support\Facades\Http;

class LocationFake
{
    public $endpoint = 'https://shopify-shop.myshopify.com/admin/api/2021-04/locations/*';

    public function fake()
    {
        $locationResponse = $this->getLocationResponse();

        Http::fake([
            $this->endpoint => Http::sequence()
                                   ->push($locationResponse, 200)
                                   ->whenEmpty(Http::response('', 404)),
       ]);
    }

    public function getLocationResponse(): string
    {
        $file = __DIR__ . '/../Stubs/Responses/Location.json';
        return file_get_contents($file);
    }
}

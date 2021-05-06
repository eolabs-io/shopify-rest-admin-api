<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Fakes;

use Illuminate\Support\Facades\Http;
use EolabsIo\ShopifyRestAdminApi\Tests\Fakes\LocationFake;

class LocationInventoryLevelsFake extends LocationFake
{
    public $endpoint = 'https://shopify-shop.myshopify.com/admin/api/2021-04/locations/*';

    public function fake()
    {
        $locationInventoryLevelsResponse = $this->getLocationInventoryLevelsResponse();

        Http::fake([
            $this->endpoint => Http::sequence()
                                   ->push($locationInventoryLevelsResponse, 200)
                                   ->whenEmpty(Http::response('', 404)),
       ]);
    }

    public function getLocationInventoryLevelsResponse(): string
    {
        $file = __DIR__ . '/../Stubs/Responses/InventoryLevels.json';
        return file_get_contents($file);
    }
}

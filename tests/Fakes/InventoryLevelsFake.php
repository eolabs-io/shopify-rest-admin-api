<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Fakes;

use Illuminate\Support\Facades\Http;

class InventoryLevelsFake
{
    public $endpoint = 'https://shopify-shop.myshopify.com/admin/api/2021-04/inventory_levels*';

    public function fake()
    {
        $inventoryLevelsResponse = $this->getInventoryLevelsResponse();

        Http::fake([
            $this->endpoint => Http::sequence()
                                   ->push($inventoryLevelsResponse, 200)
                                   ->whenEmpty(Http::response('', 404)),
       ]);
    }

    public function getInventoryLevelsResponse(): string
    {
        $file = __DIR__ . '/../Stubs/Responses/InventoryLevels.json';
        return file_get_contents($file);
    }
}

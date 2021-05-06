<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Fakes;

use Illuminate\Support\Facades\Http;

class InventoryItemFake
{
    public $endpoint = 'https://shopify-shop.myshopify.com/admin/api/2021-04/inventory_items/*';

    public function fake()
    {
        $inventoryItemResponse = $this->getInventoryItemResponse();

        Http::fake([
            $this->endpoint => Http::sequence()
                                   ->push($inventoryItemResponse, 200)
                                   ->whenEmpty(Http::response('', 404)),
       ]);
    }

    public function getInventoryItemResponse(): string
    {
        $file = __DIR__ . '/../Stubs/Responses/InventoryItem.json';
        return file_get_contents($file);
    }
}

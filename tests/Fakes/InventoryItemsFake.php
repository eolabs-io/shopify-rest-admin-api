<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Fakes;

use Illuminate\Support\Facades\Http;
use EolabsIo\ShopifyRestAdminApi\Tests\Fakes\InventoryItemFake;

class InventoryItemsFake extends InventoryItemFake
{
    public $endpoint = 'https://shopify-shop.myshopify.com/admin/api/2021-04/inventory_items.json*';

    public function fake()
    {
        $inventoryItemsResponse = $this->getInventoryItemsResponse();

        Http::fake([
            $this->endpoint => Http::sequence()
                                   ->push($inventoryItemsResponse, 200)
                                   ->whenEmpty(Http::response('', 404)),
       ]);
    }

    public function getInventoryItemsResponse(): string
    {
        $file = __DIR__ . '/../Stubs/Responses/InventoryItems.json';
        return file_get_contents($file);
    }
}

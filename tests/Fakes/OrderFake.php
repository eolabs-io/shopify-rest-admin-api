<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Fakes;

use Illuminate\Support\Facades\Http;

class OrderFake
{
    public $endpoint = 'https://shopify-shop.myshopify.com/admin/api/2021-04/orders/*';

    public function fake()
    {
        $ordersResponse = $this->getOrdersResponse();

        Http::fake([
            $this->endpoint => Http::sequence()
                                   ->push($ordersResponse, 200)
                                   ->whenEmpty(Http::response('', 404)),
       ]);
    }

    public function getOrdersResponse(): string
    {
        $file = __DIR__ . '/../Stubs/Responses/Order.json';
        return file_get_contents($file);
    }
}

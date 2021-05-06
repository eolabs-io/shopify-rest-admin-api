<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Fakes;

use EolabsIo\ShopifyRestAdminApi\Tests\Fakes\OrderFake;

class OrdersFake extends OrderFake
{
    public $endpoint = 'https://shopify-shop.myshopify.com/admin/api/2021-04/orders.json*';

    public function getOrdersResponse(): string
    {
        $file = __DIR__ . '/../Stubs/Responses/Orders.json';
        return file_get_contents($file);
    }
}

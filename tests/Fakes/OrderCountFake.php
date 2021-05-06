<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Fakes;

use EolabsIo\ShopifyRestAdminApi\Tests\Fakes\OrderFake;

class OrderCountFake extends OrderFake
{
    public $endpoint = 'https://shopify-shop.myshopify.com/admin/api/2021-04/orders/count.json*';

    public function getOrdersResponse(): string
    {
        $file = __DIR__ . '/../Stubs/Responses/OrderCount.json';
        return file_get_contents($file);
    }
}

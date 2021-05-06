<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Fakes;

use EolabsIo\ShopifyRestAdminApi\Tests\Fakes\CustomerFake;

class CustomerCountFake extends CustomerFake
{
    public $endpoint = 'https://shopify-shop.myshopify.com/admin/api/2021-04/customers/count.json*';


    public function getCustomersResponse(): string
    {
        $file = __DIR__ . '/../Stubs/Responses/CustomerCount.json';
        return file_get_contents($file);
    }
}

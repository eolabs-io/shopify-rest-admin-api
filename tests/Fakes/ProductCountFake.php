<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Fakes;

use EolabsIo\ShopifyRestAdminApi\Tests\Fakes\ProductFake;

class ProductCountFake extends ProductFake
{
    public $endpoint = 'https://shopify-shop.myshopify.com/admin/api/2021-04/products/count.json*';

    public function getProductsResponse(): string
    {
        $file = __DIR__ . '/../Stubs/Responses/ProductCount.json';
        return file_get_contents($file);
    }
}

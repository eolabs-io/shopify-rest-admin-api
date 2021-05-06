<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Fakes;

use EolabsIo\ShopifyRestAdminApi\Tests\Fakes\ProductFake;

class ProductsFake extends ProductFake
{
    public $endpoint = 'https://shopify-shop.myshopify.com/admin/api/2021-04/products.json*';

    public function getProductsResponse(): string
    {
        $file = __DIR__ . '/../Stubs/Responses/Products.json';
        return file_get_contents($file);
    }
}

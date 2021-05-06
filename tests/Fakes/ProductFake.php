<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Fakes;

use Illuminate\Support\Facades\Http;

class ProductFake
{
    public $endpoint = 'https://shopify-shop.myshopify.com/admin/api/2021-04/products/*';

    public function fake()
    {
        $productsResponse = $this->getProductsResponse();

        Http::fake([
            $this->endpoint => Http::sequence()
                                   ->push($productsResponse, 200)
                                   ->whenEmpty(Http::response('', 404)),
       ]);
    }

    public function getProductsResponse(): string
    {
        $file = __DIR__ . '/../Stubs/Responses/Product.json';
        return file_get_contents($file);
    }
}

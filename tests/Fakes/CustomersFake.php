<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Fakes;

use Illuminate\Support\Facades\Http;
use EolabsIo\ShopifyRestAdminApi\Tests\Fakes\CustomerFake;

class CustomersFake extends CustomerFake
{
    public $endpoint = 'https://shopify-shop.myshopify.com/admin/api/2021-04/customers.json*';

    public function fake()
    {
        $customersResponse = $this->getCustomersResponse();

        Http::fake([
            $this->endpoint => Http::sequence()
                                   ->push($customersResponse, 200)
                                   ->whenEmpty(Http::response('', 404)),
       ]);
    }

    public function getCustomersResponse(): string
    {
        $file = __DIR__ . '/../Stubs/Responses/Customers.json';
        return file_get_contents($file);
    }
}

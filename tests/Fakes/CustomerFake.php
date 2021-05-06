<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Fakes;

use Illuminate\Support\Facades\Http;

class CustomerFake
{
    public $endpoint = 'https://shopify-shop.myshopify.com/admin/api/2021-04/customers/*';

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
        $file = __DIR__ . '/../Stubs/Responses/Customer.json';
        return file_get_contents($file);
    }
}

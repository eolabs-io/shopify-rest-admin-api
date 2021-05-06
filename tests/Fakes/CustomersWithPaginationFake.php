<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Fakes;

use Illuminate\Support\Facades\Http;
use EolabsIo\ShopifyRestAdminApi\Tests\Fakes\CustomerFake;

class CustomersWithPaginationFake extends CustomerFake
{
    public $endpoint = 'https://shopify-shop.myshopify.com/admin/api/2021-04/customers.json*';

    public function fake()
    {
        $customersResponse = $this->getCustomersResponse();
        $customersWithNextPageResponse = $this->getCustomersWithNextPageResponse();

        Http::fake([
            $this->endpoint => Http::sequence()
                                   ->push($customersResponse, 200, $this->getHeaders(true))
                                   ->push($customersWithNextPageResponse, 200)
                                   ->whenEmpty(Http::response('', 404)),
       ]);
    }

    public function getCustomersResponse(): string
    {
        $file = __DIR__ . '/../Stubs/Responses/Customers.json';
        return file_get_contents($file);
    }

    public function getCustomersWithNextPageResponse()
    {
        $file = __DIR__ . '/../Stubs/Responses/CustomersWithNextPage.json';
        return file_get_contents($file);
    }

    public function getHeaders($withPagination = false): array
    {
        return ($withPagination)
            ? ['Link' => "https://shopify-shop.myshopify.com/admin/api/2021-04/customers.json?page_info=jgkhilmn&limit=3>; rel=\"prev\",https://shopify-shop.myshopify.com/admin/api/2021-04/customers.json?page_info=hijgklmn&limit=3>; rel=\"next\"",]
            : [];
    }
}

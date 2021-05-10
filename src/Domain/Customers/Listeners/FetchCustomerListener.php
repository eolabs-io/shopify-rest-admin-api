<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Customers\Listeners;

use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Events\FetchCustomer;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Jobs\PerformFetchCustomer;

class FetchCustomerListener
{
    public function handle(FetchCustomer $event)
    {
        $customer = $event->customer;
        PerformFetchCustomer::dispatch($customer)->onQueue('shopify-rest-admin-api');
    }
}

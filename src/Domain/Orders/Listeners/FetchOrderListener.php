<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Listeners;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Events\FetchOrder;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Jobs\PerformFetchOrder;

class FetchOrderListener
{
    public function handle(FetchOrder $event)
    {
        $order = $event->order;
        PerformFetchOrder::dispatch($order)->onQueue('shopify-rest-admin-api');
    }
}

<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Products\Listeners;

use EolabsIo\ShopifyRestAdminApi\Domain\Products\Events\FetchProduct;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Jobs\PerformFetchProduct;

class FetchProductListener
{
    public function handle(FetchProduct $event)
    {
        $product = $event->product;
        PerformFetchProduct::dispatch($product)->onQueue('shopify-rest-admin-api');
    }
}

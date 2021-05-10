<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Listeners;

use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Events\FetchLocation;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Jobs\PerformFetchLocation;

class FetchLocationListener
{
    public function handle(FetchLocation $event)
    {
        $location = $event->location;
        PerformFetchLocation::dispatch($location)->onQueue('shopify-rest-admin-api');
    }
}

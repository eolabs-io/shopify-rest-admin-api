<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Shared\Middleware;

use EolabsIo\ThrottlingMiddleware\Throttled;

class ShopifyThrottlingMiddleware
{
    public function forShopify()
    {
        return (new Throttled)
            ->key('shopify-rest-admin-api-throttle')
            ->maximumQuota(40)
            ->restoreRate(2);
    }

    public function forShopifyPlus()
    {
        return (new Throttled)
            ->key('shopify-plus-rest-admin-api-throttle')
            ->maximumQuota(80)
            ->restoreRate(4);
    }
}

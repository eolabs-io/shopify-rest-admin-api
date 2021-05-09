<?php

namespace EolabsIo\ShopifyRestAdminApi\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 * @see EolabsIo\ShopifyRestAdminApi\Domain\Shared\Middleware\ShopifyThrottlingMiddleware
 */
class ShopifyThrottlingMiddleware extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'shopify-throttling-middleware';
    }
}

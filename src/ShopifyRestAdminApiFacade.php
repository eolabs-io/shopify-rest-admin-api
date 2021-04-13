<?php

namespace EolabsIo\ShopifyRestAdminApi;

use Illuminate\Support\Facades\Facade;

/**
 * @see \EolabsIo\ShopifyRestAdminApi\Skeleton\SkeletonClass
 */
class ShopifyRestAdminApiFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'shopify-rest-admin-api';
    }
}

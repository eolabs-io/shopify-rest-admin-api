<?php

namespace EolabsIo\ShopifyRestAdminApi\Support\Facades;

use Illuminate\Support\Facades\Facade;
use EolabsIo\ShopifyRestAdminApi\Tests\Fakes\ProductFake;
use EolabsIo\ShopifyRestAdminApi\Tests\Fakes\ProductsFake;
use EolabsIo\ShopifyRestAdminApi\Tests\Fakes\ProductCountFake;

/**
 *
 * @see EolabsIo\ShopifyRestAdminApi\Domain\Products\Product;
 */
class Product extends Facade
{
    public static function fake($options = [])
    {
        $type = data_get($options, 'type');

        $fake = static::getProductFake($type);
        $fake->fake();

        return $fake;
    }

    public static function getProductFake($type): ProductFake
    {
        switch ($type) {
            case '__Product__':
                return new ProductFake;
            case '__ProductCount__':
                return new ProductCountFake;
            default:
                return new ProductsFake;
        }
    }

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'shopify-admin-api-product';
    }
}

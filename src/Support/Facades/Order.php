<?php

namespace EolabsIo\ShopifyRestAdminApi\Support\Facades;

use Illuminate\Support\Facades\Facade;
use EolabsIo\ShopifyRestAdminApi\Tests\Fakes\OrderFake;
use EolabsIo\ShopifyRestAdminApi\Tests\Fakes\OrdersFake;
use EolabsIo\ShopifyRestAdminApi\Tests\Fakes\OrderCountFake;

/**
 *
 * @see EolabsIo\WalmartApi\Domain\Marketplace\Items\Items;
 */
class Order extends Facade
{
    public static function fake($options = [])
    {
        $type = data_get($options, 'type');

        $fake = static::getOrderFake($type);
        $fake->fake();

        return $fake;
    }

    public static function getOrderFake($type): OrderFake
    {
        switch ($type) {
            case '__Order__':
                return new OrderFake;
            case '__OrderCount__':
                return new OrderCountFake;
            default:
                return new OrdersFake;
        }
    }

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'shopify-admin-api-order';
    }
}

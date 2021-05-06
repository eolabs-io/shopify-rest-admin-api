<?php

namespace EolabsIo\ShopifyRestAdminApi\Support\Facades;

use Illuminate\Support\Facades\Facade;
use EolabsIo\ShopifyRestAdminApi\Tests\Fakes\LocationFake;
use EolabsIo\ShopifyRestAdminApi\Tests\Fakes\LocationsFake;
use EolabsIo\ShopifyRestAdminApi\Tests\Fakes\LocationCountFake;
use EolabsIo\ShopifyRestAdminApi\Tests\Fakes\LocationInventoryLevelsFake;

/**
 *
 * @see
 */
class Location extends Facade
{
    public static function fake($options = [])
    {
        $type = data_get($options, 'type');

        $fake = static::getLocationFake($type);
        $fake->fake();

        return $fake;
    }

    public static function getLocationFake($type): LocationFake
    {
        switch ($type) {
            case '__Location__':
                return new LocationFake;
            case '__LocationCount__':
                return new LocationCountFake;
            case '__InventoryLevels__':
                return new LocationInventoryLevelsFake;
            default:
                return new LocationsFake;
        }
    }

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'shopify-admin-api-location';
    }
}

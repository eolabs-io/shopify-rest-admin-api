<?php

namespace EolabsIo\ShopifyRestAdminApi\Support\Facades;

use Illuminate\Support\Facades\Facade;
use EolabsIo\ShopifyRestAdminApi\Tests\Fakes\InventoryLevelsFake;

/**
 *
 * @see
 */
class InventoryLevel extends Facade
{
    public static function fake($options = [])
    {
        $type = data_get($options, 'type');

        $fake = static::getFake($type);
        $fake->fake();

        return $fake;
    }

    public static function getFake($type): InventoryLevelsFake
    {
        return new InventoryLevelsFake;
    }

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'shopify-admin-api-inventory-level';
    }
}

<?php

namespace EolabsIo\ShopifyRestAdminApi\Support\Facades;

use Illuminate\Support\Facades\Facade;
use EolabsIo\ShopifyRestAdminApi\Tests\Fakes\InventoryItemFake;
use EolabsIo\ShopifyRestAdminApi\Tests\Fakes\InventoryItemsFake;

/**
 *
 * @see
 */
class InventoryItem extends Facade
{
    public static function fake($options = [])
    {
        $type = data_get($options, 'type');

        $fake = static::getFake($type);
        $fake->fake();

        return $fake;
    }

    public static function getFake($type): InventoryItemFake
    {
        switch ($type) {
            case '__InventoryItem__':
                return new InventoryItemFake;
            default:
                return new InventoryItemsFake;
        }
    }

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'shopify-admin-api-inventory-item';
    }
}

<?php

namespace EolabsIo\ShopifyRestAdminApi\Support\Facades;

use Illuminate\Support\Facades\Facade;
use EolabsIo\ShopifyRestAdminApi\Tests\Fakes\CustomerFake;
use EolabsIo\ShopifyRestAdminApi\Tests\Fakes\CustomersFake;
use EolabsIo\ShopifyRestAdminApi\Tests\Fakes\CustomerCountFake;
use EolabsIo\ShopifyRestAdminApi\Tests\Fakes\CustomersWithPaginationFake;

/**
 *
 * @see EolabsIo\ShopifyRestAdminApi\Domain\Customers\Customer
 */
class Customer extends Facade
{
    public static function fake($options = [])
    {
        $type = data_get($options, 'type');

        $fake = static::getCustomerFake($type);
        $fake->fake();

        return $fake;
    }

    public static function getCustomerFake($type): CustomerFake
    {
        switch ($type) {
            case '__Customer__':
                return new CustomerFake;
            case '__CustomerCount__':
                return new CustomerCountFake;
            case '__CustomerWithPagination__':
                return new CustomersWithPaginationFake;
            default:
                return new CustomersFake;
        }
    }

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'shopify-admin-api-customer';
    }
}

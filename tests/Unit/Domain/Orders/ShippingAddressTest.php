<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Orders;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\ShippingAddress;

class ShippingAddressTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ShippingAddress::class;
    }
}

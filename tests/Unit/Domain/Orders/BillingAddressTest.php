<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Orders;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\BillingAddress;

class BillingAddressTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return BillingAddress::class;
    }
}

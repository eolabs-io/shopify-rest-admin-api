<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Customers;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Models\Address;

class AddressTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Address::class;
    }
}

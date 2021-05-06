<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Orders;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Money;

class MoneyTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Money::class;
    }
}

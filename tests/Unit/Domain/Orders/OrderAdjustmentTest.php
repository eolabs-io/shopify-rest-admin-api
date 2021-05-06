<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Orders;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\OrderAdjustment;

class OrderAdjustmentTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return OrderAdjustment::class;
    }
}

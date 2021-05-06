<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Orders;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\DiscountAllocation;

class DiscountAllocationTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return DiscountAllocation::class;
    }
}

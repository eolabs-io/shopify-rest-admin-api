<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Orders;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\DiscountCode;

class DiscountCodeTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return DiscountCode::class;
    }
}

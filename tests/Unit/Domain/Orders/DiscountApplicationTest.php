<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Orders;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\DiscountApplication;

class DiscountApplicationTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return DiscountApplication::class;
    }
}

<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Orders;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\ShippingLine;

class ShippingLineTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ShippingLine::class;
    }
}

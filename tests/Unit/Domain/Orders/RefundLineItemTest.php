<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Orders;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\RefundLineItem;

class RefundLineItemTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return RefundLineItem::class;
    }
}

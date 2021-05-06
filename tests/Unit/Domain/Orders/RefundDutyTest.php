<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Orders;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\RefundDuty;

class RefundDutyTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return RefundDuty::class;
    }
}

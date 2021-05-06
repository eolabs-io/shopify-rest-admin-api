<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Orders;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\PaymentDetails;

class PaymentDetailsTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return PaymentDetails::class;
    }
}

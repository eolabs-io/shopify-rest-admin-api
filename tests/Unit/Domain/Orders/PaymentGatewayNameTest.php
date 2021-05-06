<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Orders;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\PaymentGatewayName;

class PaymentGatewayNameTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return PaymentGatewayName::class;
    }
}

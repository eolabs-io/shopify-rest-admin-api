<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\ShippingFulfillment;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\ShippingFulfillment\Models\Receipt;

class ReceiptTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Receipt::class;
    }
}

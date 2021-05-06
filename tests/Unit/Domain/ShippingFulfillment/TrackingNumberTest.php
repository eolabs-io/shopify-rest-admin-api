<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\ShippingFulfillment;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\ShippingFulfillment\Models\TrackingNumber;

class TrackingNumberTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return TrackingNumber::class;
    }
}

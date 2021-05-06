<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\ShippingFulfillment;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\ShippingFulfillment\Models\TrackingUrl;

class TrackingUrlTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return TrackingUrl::class;
    }
}

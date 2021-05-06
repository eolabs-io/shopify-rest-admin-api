<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Orders;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Property;

class PropertyTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Property::class;
    }
}

<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Inventory;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Models\Location;

class LocationTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Location::class;
    }
}

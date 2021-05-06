<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Inventory;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Models\InventoryLevel;

class InventoryLevelTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return InventoryLevel::class;
    }
}

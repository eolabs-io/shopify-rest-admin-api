<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Inventory;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Models\InventoryItem;

class InventoryItemTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return InventoryItem::class;
    }
}

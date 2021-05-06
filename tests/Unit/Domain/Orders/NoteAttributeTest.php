<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Orders;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\NoteAttribute;

class NoteAttributeTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return NoteAttribute::class;
    }
}

<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Products;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\Price;

class PriceTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Price::class;
    }
}

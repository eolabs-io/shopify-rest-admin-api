<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Products;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\ProductOptionValue;

class ProductOptionValueTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ProductOptionValue::class;
    }
}

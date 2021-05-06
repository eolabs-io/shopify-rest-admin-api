<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Products;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\ProductVariant;

class ProductVariantTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ProductVariant::class;
    }
}

<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Products;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\ProductImage;

class ProductImageTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ProductImage::class;
    }
}

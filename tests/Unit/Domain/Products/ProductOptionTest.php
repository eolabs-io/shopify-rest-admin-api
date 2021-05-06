<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Products;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\ProductOption;

class ProductOptionTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ProductOption::class;
    }

    /** @test */
    public function it_has_values_relationship()
    {
        ProductOption::factory()->hasValues()->create();

        $this->assertDatabaseCount('product_option_values', 1);
        $this->assertEquals(1, ProductOption::first()->values()->count());
    }
}

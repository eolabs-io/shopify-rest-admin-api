<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Products;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\PresentmentPrice;

class PresentmentPriceTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return PresentmentPrice::class;
    }

    /** @test */
    public function it_has_price_relationship()
    {
        PresentmentPrice::factory()->hasPrice()->create();

        $this->assertDatabaseCount('presentment_prices', 1);
        $this->assertEquals(1, PresentmentPrice::first()->price()->count());
    }

    /** @test */
    public function it_has_compare_at_price_relationship()
    {
        PresentmentPrice::factory()->hasCompareAtPrice()->create();

        $this->assertDatabaseCount('presentment_prices', 1);
        $this->assertEquals(1, PresentmentPrice::first()->compareAtPrice()->count());
    }
}

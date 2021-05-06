<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Orders;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\DiscountAllocation;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Duty;
use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\LineItem;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Property;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\TaxLine;

class LineItemTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return LineItem::class;
    }

    /** @test */
    public function it_has_properties_relationship()
    {
        $lineItem = LineItem::factory()->create();
        $expectedProperties = Property::factory()->times(3)->create(['line_item_id' => $lineItem->id]);

        $actualProperties = $lineItem->properties;

        $this->assertArraysEqual($expectedProperties->toArray(), $actualProperties->toArray());
    }

    /** @test */
    public function it_has_discount_allocations_relationship()
    {
        $lineItem = LineItem::factory()->create();
        $expectedDiscountAllocations = DiscountAllocation::factory()->times(3)->create(['line_item_id' => $lineItem->id]);

        $actualDiscountAllocations = $lineItem->discountAllocations;

        $this->assertArraysEqual($expectedDiscountAllocations->toArray(), $actualDiscountAllocations->toArray());
    }

    /** @test */
    public function it_has_duties_relationship()
    {
        $lineItem = LineItem::factory()->create();
        $expectedDuties = Duty::factory()->times(3)->create(['line_item_id' => $lineItem->id]);

        $actualDuties = $lineItem->duties;

        $this->assertArraysEqual($expectedDuties->toArray(), $actualDuties->toArray());
    }

    /** @test */
    public function it_has_taxLines_relationship()
    {
        $lineItem = LineItem::factory()->create();
        $expectedTaxLines = TaxLine::factory()->times(3)->create();
        $lineItem->taxLines()->attach($expectedTaxLines);

        $actualTaxLines = $lineItem->taxLines;

        $this->assertEquals($expectedTaxLines->toArray(), $actualTaxLines->toArray());
    }
}

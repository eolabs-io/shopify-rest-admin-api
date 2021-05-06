<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Orders;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Duty;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\TaxLine;

class DutyTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Duty::class;
    }

    /** @test */
    public function it_has_tax_lines_relationship()
    {
        $taxLines = TaxLine::factory()->times(3)->create();

        $duty = Duty::factory()->create();
        $duty->taxLines()->attach($taxLines);

        $findDuty = Duty::with([
            'taxLines',
            'shopMoney',
            'presentmentMoney',
        ])->first();

        $this->assertEquals($taxLines->toArray(), $findDuty->taxLines->toArray());
    }
}

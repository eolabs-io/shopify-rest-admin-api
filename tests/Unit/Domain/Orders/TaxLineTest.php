<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Orders;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\TaxLine;

class TaxLineTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return TaxLine::class;
    }
}

<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Customers;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Models\TaxExemption;

class TaxExemptionTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return TaxExemption::class;
    }
}

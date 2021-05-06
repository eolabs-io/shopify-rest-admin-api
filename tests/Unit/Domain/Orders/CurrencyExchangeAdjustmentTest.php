<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Orders;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\CurrencyExchangeAdjustment;

class CurrencyExchangeAdjustmentTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return CurrencyExchangeAdjustment::class;
    }
}

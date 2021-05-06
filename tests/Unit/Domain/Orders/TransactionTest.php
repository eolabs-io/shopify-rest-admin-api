<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Orders;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Transaction;

class TransactionTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Transaction::class;
    }
}

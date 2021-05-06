<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Unit\Orders;

use EolabsIo\ShopifyRestAdminApi\Tests\Unit\BaseModelTest;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\ClientDetails;

class ClientDetailsTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ClientDetails::class;
    }
}

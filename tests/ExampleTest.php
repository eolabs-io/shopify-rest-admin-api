<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests;

use Orchestra\Testbench\TestCase;
use EolabsIo\ShopifyRestAdminApi\ShopifyRestAdminApiServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [ShopifyRestAdminApiServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}

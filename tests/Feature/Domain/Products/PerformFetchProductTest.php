<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Feature\Products;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\ShopifyRestAdminApi\Tests\TestCase;
use EolabsIo\ShopifyRestAdminApi\Support\Facades\Product;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Jobs\PerformFetchProduct;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Jobs\ProcessFetchProductResponse;

class PerformFetchProductTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
        Event::fake();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /** @test */
    public function it_calls_the_correct_job()
    {
        Product::fake();

        PerformFetchProduct::dispatch(Product::withLimit());

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchProduct::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessFetchProductResponse::class, function ($job) {
            return data_get($job->results, 'products.0.id') === 632910392;
        });
    }
}

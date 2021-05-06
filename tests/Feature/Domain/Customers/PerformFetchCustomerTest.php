<?php

namespace EolabsIo\ShopifyRestAdminApi\Tests\Feature\Customers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\ShopifyRestAdminApi\Tests\TestCase;
use EolabsIo\ShopifyRestAdminApi\Support\Facades\Customer;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Events\FetchCustomer;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Jobs\PerformFetchCustomer;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Jobs\ProcessFetchCustomerResponse;

class PerformFetchCustomerTest extends TestCase
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
        Customer::fake();

        PerformFetchCustomer::dispatch(Customer::withLimit());

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchCustomer::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessFetchCustomerResponse::class, function ($job) {
            return data_get($job->results, 'customers.0.id') === 207119551;
        });

        // Assert that was not called for NextPage
        Event::assertNotDispatched(FetchCustomer::class);
    }

    /** @test */
    public function it_calls_the_correct_job_with_next_page()
    {
        Customer::fake([
            'type' => '__CustomerWithPagination__',
        ]);

        PerformFetchCustomer::dispatch(Customer::withLimit());

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchCustomer::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessFetchCustomerResponse::class, function ($job) {
            return data_get($job->results, 'customers.0.id') === 207119551;
        });

        // Assert that was called for NextPage
        Event::assertDispatched(FetchCustomer::class);
    }
}

<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Customers\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\RequestException;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Customer;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Events\FetchCustomer;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Jobs\ProcessFetchCustomerResponse;

class PerformFetchCustomer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /** @var EolabsIo\ShopifyRestAdminApi\Domain\Customers\Customer */
    public $customer;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $results = $this->customer->fetch();

            ProcessFetchCustomerResponse::dispatch($results);
            FetchCustomer::dispatchIf($this->customer->hasNextPage(), $this->customer);
        } catch (RequestException $exception) {
            // $delay = 30;
            // $this->handleRequestException($exception, $delay);
        }
    }
}

<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Customers\Command;

use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Customer;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Events\FetchCustomer;

class CustomerCommand extends Command
{
    protected $signature = 'shopifyApi:customer
                            {--ids=* : Return only customers specified by list of customer IDs.}
                            {--since-id= : Return only customers after the specified ID.}
                            {--created-at-min= : Return customers created after a specified date.}
                            {--created-at-max= : Return customers created before a specified date.}
                            {--updated-at-min= : Return customers updated after a specified date.}
                            {--updated-at-max= : Return customers updated before a specified date.}
                            {--limit= : Return up to this many results per page.}
                            {--fields=* : Return only certain fields specified by a list of field names.}';


    protected $description = 'Gets Customers from Shopify';


    public function handle()
    {
        $this->info('Getting Customers from Shopify...');

        $customer = new Customer;

        $customer = $this->applyOptions($customer);

        FetchCustomer::dispatch($customer);
    }

    public function applyOptions(Customer $customer): Customer
    {
        // Apply customers
        if ($ids = $this->option('ids')) {
            $customer->withCustomerIds($ids);
        }

        if ($sinceId = $this->option('since-id')) {
            $customer->withSinceId($sinceId);
        }

        if ($createdAtMin = $this->option('created-at-min')) {
            $customer->withCreatedAtMin(Carbon::create($createdAtMin));
        }

        if ($createdAtMax = $this->option('created-at-max')) {
            $customer->withCreatedAtMax(Carbon::create($createdAtMax));
        }

        if ($updatedAtMin = $this->option('updated-at-min')) {
            $customer->withUpdatedAtMin(Carbon::create($updatedAtMin));
        }

        if ($updatedAtMax = $this->option('updated-at-max')) {
            $customer->withUpdatedAtMax(Carbon::create($updatedAtMax));
        }

        if ($limit = $this->option('limit')) {
            $customer->withLimit($limit);
        }

        if ($fields = $this->option('fields')) {
            $customer->withFields($fields);
        }

        return $customer;
    }
}

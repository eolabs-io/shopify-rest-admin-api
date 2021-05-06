<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Customers\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Customer;

class FetchCustomer
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\ShopifyRestAdminApi\Domain\Customers\Customer */
    public $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }
}

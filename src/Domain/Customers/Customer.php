<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Customers;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\ShopifyCore;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Concerns\CustomerQueryable;

class Customer extends ShopifyCore
{
    use CustomerQueryable;

    public function fetch()
    {
        if ($this->hasCustomerId()) {
            // A Customer
            $id = $this->getCustomerId();
            $endpoint = "/customers/{$id}.json";
            $parameters = $this->getCustomerQueryableParameters();
        } else {
            // Displays a list of all Customers by using query parameters
            $endpoint = '/customers.json';
            $parameters = $this->getCustomerQueryableParameters();
        }

        return $this->get($endpoint, $parameters);
    }


    public function count()
    {
        $endpoint = '/customers/count.json';
        $parameters = $this->getCustomerQueryableParameters();

        return $this->get($endpoint, $parameters);
    }
}

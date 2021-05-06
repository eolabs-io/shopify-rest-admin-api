<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\ShopifyCore;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Concerns\OrderQueryable;

class Order extends ShopifyCore
{
    use OrderQueryable;

    public function fetch()
    {
        if ($this->hasOrderId()) {
            // A Order
            $id = $this->getOrderId();
            $endpoint = "/orders/{$id}.json";
            $parameters = $this->getOrderQueryableParameters();
        } else {
            // Displays a list of all Orders by using query parameters
            $endpoint = '/orders.json';
            $parameters = $this->getOrderQueryableParameters();
        }

        return $this->get($endpoint, $parameters);
    }


    public function count()
    {
        $endpoint = '/orders/count.json';
        $parameters = $this->getOrderQueryableParameters();

        return $this->get($endpoint, $parameters);
    }
}

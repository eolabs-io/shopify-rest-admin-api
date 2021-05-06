<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Products;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\ShopifyCore;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Concerns\ProductQueryable;

class Product extends ShopifyCore
{
    use ProductQueryable;

    public function fetch()
    {
        if ($this->hasProductId()) {
            // A product
            $id = $this->getProductId();
            $endpoint = "/products/{$id}.json";
            $parameters = $this->getProductQueryableParameters();
        } else {
            // Displays a list of all products by using query parameters
            $endpoint = '/products.json';
            $parameters = $this->getProductQueryableParameters();
        }

        return $this->get($endpoint, $parameters);
    }


    public function count()
    {
        $endpoint = '/products/count.json';
        $parameters = $this->getProductQueryableParameters();

        return $this->get($endpoint, $parameters);
    }
}

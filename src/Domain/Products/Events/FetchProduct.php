<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Products\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Product;

class FetchProduct
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\ShopifyRestAdminApi\Domain\Products\Product */
    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
}

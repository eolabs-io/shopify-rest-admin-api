<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Order;

class FetchOrder
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\ShopifyRestAdminApi\Domain\Orders\Order */
    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }
}

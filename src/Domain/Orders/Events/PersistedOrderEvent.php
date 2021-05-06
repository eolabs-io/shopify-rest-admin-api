<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Events;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Order;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class PersistedOrderEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Order */
    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }
}

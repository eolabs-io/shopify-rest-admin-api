<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Events;

use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Models\Location;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class PersistedLocationEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Models\Location */
    public $location;

    public function __construct(Location $location)
    {
        $this->location = $location;
    }
}

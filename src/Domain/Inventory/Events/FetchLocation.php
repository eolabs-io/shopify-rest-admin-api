<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Location;

class FetchLocation
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Location */
    public $location;

    public function __construct(Location $location)
    {
        $this->location = $location;
    }
}

<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Command;

use Illuminate\Console\Command;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Location;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Events\FetchLocation;

class LocationCommand extends Command
{
    protected $signature = 'shopifyApi:location';

    protected $description = 'Gets Locations from Shopify';


    public function handle()
    {
        $this->info('Getting Locations from Shopify...');

        $location = new Location;

        FetchLocation::dispatch($location);
    }
}

<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Inventory;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\ShopifyCore;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Concerns\LocationQueryable;

class Location extends ShopifyCore
{
    use LocationQueryable;

    public function fetch()
    {
        if ($this->hasLocationId()) {
            // A Location
            $id = $this->getLocationId();
            $endpoint = "/locations/{$id}.json";
            $parameters = $this->getLocationQueryableParameters();
        } else {
            // Displays a list of all Locations by using query parameters
            $endpoint = '/locations.json';
            $parameters = $this->getLocationQueryableParameters();
        }

        return $this->get($endpoint, $parameters);
    }


    public function count()
    {
        $endpoint = '/locations/count.json';
        $parameters = $this->getLocationQueryableParameters();

        return $this->get($endpoint, $parameters);
    }

    public function inventoryLevels()
    {
        $id = $this->getLocationId();
        $endpoint = "/locations/{$id}/inventory_levels.json";
        $parameters = $this->getLocationQueryableParameters();

        return $this->get($endpoint, $parameters);
    }
}

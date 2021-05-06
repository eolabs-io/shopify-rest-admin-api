<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Models\Location;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Events\PersistedLocationEvent;

class PersistLocationAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'locations';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new Location);
        $attributes = ['id' => data_get($list, 'id')];

        $location = Location::updateOrCreate($attributes, $values);

        return $location;
    }

    public function getPersistedEvent()
    {
        return PersistedLocationEvent::class;
    }
}

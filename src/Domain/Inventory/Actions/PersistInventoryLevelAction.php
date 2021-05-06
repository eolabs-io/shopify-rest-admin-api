<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Models\InventoryLevel;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Events\PersistedInventoryLevelEvent;

class PersistInventoryLevelAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'inventory_levels';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new InventoryLevel);
        $attributes = [
            'inventory_item_id' => data_get($list, 'inventory_item_id'),
            'location_id' => data_get($list, 'location_id'),
        ];

        $inventoryLevel = InventoryLevel::updateOrCreate($attributes, $values);

        return $inventoryLevel;
    }

    public function getPersistedEvent()
    {
        return PersistedInventoryLevelEvent::class;
    }
}

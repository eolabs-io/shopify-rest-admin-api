<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Models\InventoryItem;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\ShopifyRestAdminApi\Domain\Inventory\Events\PersistedInventoryItemEvent;

class PersistInventoryItemAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'inventory_items';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new InventoryItem);
        $attributes = ['id' => data_get($list, 'id')];

        $inventoryItem = InventoryItem::updateOrCreate($attributes, $values);

        return $inventoryItem;
    }

    public function getPersistedEvent()
    {
        return PersistedInventoryItemEvent::class;
    }
}

<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Property;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;

class AttachPropertiesAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'properties';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Property);
        $values['line_item_id'] = $this->model->id;
        $attributes = $values;

        $property = Property::firstOrCreate($attributes, $values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($property);
        }

        $property->save();
    }

    protected function associateActions(): array
    {
        return [];
    }
}

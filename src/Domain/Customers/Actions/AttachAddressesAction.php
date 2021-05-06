<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Customers\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Models\Address;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;

class AttachAddressesAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'addresses';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Address);
        $attributes = ['id' => data_get($list, 'id')];

        $address = Address::updateOrCreate($attributes, $values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($address);
        }

        $address->push();
    }

    protected function associateActions(): array
    {
        return [];
    }
}

<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Customers\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Models\Address;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAssociateAction;

class AssociateDefaultAddressAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'default_address';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Address);
        $attributes = ['id' => data_get($list, 'id')];

        $address = Address::updateOrCreate($attributes, $values);

        $this->model->default_address_id = $address->id;
        $this->model->save();
    }
}

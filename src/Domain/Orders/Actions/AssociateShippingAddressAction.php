<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Models\Address;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAssociateAction;

class AssociateShippingAddressAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'shipping_address';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Address);
        $shippingAddress = $this->model->shippingAddress;
        $shippingAddress->fill($values)->save();

        $this->model->shippingAddress()->associate($shippingAddress);
    }
}

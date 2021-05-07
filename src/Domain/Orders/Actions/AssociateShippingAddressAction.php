<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\ShippingAddress;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAssociateAction;

class AssociateShippingAddressAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'shipping_address';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ShippingAddress);
        $values = $this->validateModelId($values, ShippingAddress::class);
        $shippingAddress = $this->model->shippingAddress;
        $shippingAddress->fill($values)->save();

        $this->model->shippingAddress()->associate($shippingAddress);
    }
}

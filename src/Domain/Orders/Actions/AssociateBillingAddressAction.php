<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Models\Address;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAssociateAction;

class AssociateBillingAddressAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'billing_address';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Address);
        $values = $this->validateModelId($values, Address::class);
        $billingAddress = $this->model->billingAddress;
        $billingAddress->fill($values)->save();

        $this->model->billingAddress()->associate($billingAddress);
    }
}

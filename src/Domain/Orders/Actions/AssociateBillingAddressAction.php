<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\BillingAddress;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAssociateAction;

class AssociateBillingAddressAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'billing_address';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new BillingAddress);
        $values = $this->validateModelId($values, BillingAddress::class);
        $billingAddress = $this->model->billingAddress;
        $billingAddress->fill($values)->save();

        $this->model->billingAddress()->associate($billingAddress);
    }
}

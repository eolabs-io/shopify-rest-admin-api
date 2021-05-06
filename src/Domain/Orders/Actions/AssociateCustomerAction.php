<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAssociateAction;

class AssociateCustomerAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'customer';
    }

    protected function createItem($list)
    {
        $customerId = data_get($list, 'id');
        $this->model->customer_id = $customerId;
    }
}

<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAssociateAction;
use EolabsIo\ShopifyRestAdminApi\Domain\ShippingFulfillment\Models\Receipt;

class AssociateReceiptAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'receipt';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Receipt);
        $receipt = $this->model->receipt->fill($values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($receipt);
        }

        $receipt->save();

        $this->model->receipt()->associate($receipt);
    }

    protected function associateActions(): array
    {
        return [];
    }
}

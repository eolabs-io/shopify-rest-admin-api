<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\LineItem;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;

class AttachLineItemsToFulfillmentAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'line_items';
    }

    protected function createItem($list)
    {
        $line_item_id = data_get($list, 'id');

        if ($lineItem = LineItem::first($line_item_id)) {
            $this->model->lineItems()->attach($lineItem);
        }
    }
}

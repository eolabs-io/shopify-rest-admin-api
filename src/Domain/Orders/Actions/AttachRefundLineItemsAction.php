<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\RefundLineItem;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociateLineItemAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociateSubtotalSetAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociateTotalTaxSetAction;

class AttachRefundLineItemsAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'refund_line_items';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new RefundLineItem);
        $values['refund_id'] = $this->model->id;
        $attributes = ['id' => data_get($list, 'id')];

        $refundLineItem = RefundLineItem::firstOrNew($attributes, $values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($refundLineItem);
        }

        $refundLineItem->save();
    }

    protected function associateActions(): array
    {
        return [
            AssociateLineItemAction::class,
            AssociateSubtotalSetAction::class,
            AssociateTotalTaxSetAction::class,
        ];
    }
}

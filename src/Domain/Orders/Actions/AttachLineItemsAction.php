<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\LineItem;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AttachDutiesAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AttachPropertiesAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociatePriceSetAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociateTotalDiscountSetAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AttachDiscountAllocationsAction;

class AttachLineItemsAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'line_items';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new LineItem);
        $values['order_id'] = $this->model->id;
        $attributes = $values;

        $lineItem = LineItem::firstOrNew($attributes, $values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($lineItem);
        }

        $lineItem->save();

        foreach ($this->attachActions() as $attachAction) {
            (new $attachAction($list))->execute($lineItem);
        }
    }

    protected function associateActions(): array
    {
        return [
            AssociatePriceSetAction::class,
            AssociateTotalDiscountSetAction::class,
        ];
    }

    protected function attachActions(): array
    {
        return [
            AttachPropertiesAction::class,
            AttachDiscountAllocationsAction::class,
            AttachDutiesAction::class,
            AttachTaxLinesAction::class,
        ];
    }
}

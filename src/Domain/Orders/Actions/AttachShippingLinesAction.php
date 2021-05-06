<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\ShippingLine;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AttachTaxLinesAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociatePriceSetAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AttachRefundDutiesAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AttachTransactionsAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AttachRefundLineItemsAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AttachOrderAdjustmentsAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociateDiscountedPriceSetAction;

class AttachShippingLinesAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'shipping_lines';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ShippingLine);
        $values['order_id'] = $this->model->id;
        $attributes = ['id' => data_get($list, 'id')];

        $shippingLine = ShippingLine::firstOrNew($attributes, $values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($shippingLine);
        }

        $shippingLine->save();

        foreach ($this->attachActions() as $attachAction) {
            (new $attachAction($list))->execute($shippingLine);
        }
    }

    protected function associateActions(): array
    {
        return [
            AssociatePriceSetAction::class,
            AssociateDiscountedPriceSetAction::class,
        ];
    }

    protected function attachActions(): array
    {
        return [
            AttachTaxLinesAction::class,
        ];
    }
}

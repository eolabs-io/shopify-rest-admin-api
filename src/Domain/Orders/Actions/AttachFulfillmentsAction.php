<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociateReceiptAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\ShopifyRestAdminApi\Domain\ShippingFulfillment\Models\Fulfillment;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AttachTrackingUrlsAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AttachTrackingNumbersAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AttachLineItemsToFulfillmentAction;

class AttachFulfillmentsAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'fulfillments';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Fulfillment);
        $attributes = ['id' => data_get($list, 'id')];

        $fulfillment = Fulfillment::firstOrNew($attributes, $values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($fulfillment);
        }

        $fulfillment->save();

        foreach ($this->attachActions() as $attachAction) {
            (new $attachAction($list))->execute($fulfillment);
        }
    }

    protected function associateActions(): array
    {
        return [
            AssociateReceiptAction::class,
        ];
    }

    protected function attachActions(): array
    {
        return [
            AttachLineItemsToFulfillmentAction::class,
            AttachTrackingNumbersAction::class,
            AttachTrackingUrlsAction::class,
        ];
    }
}

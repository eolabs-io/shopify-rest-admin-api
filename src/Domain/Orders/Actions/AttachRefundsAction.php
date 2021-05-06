<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Refund;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AttachRefundDutiesAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AttachTransactionsAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AttachRefundLineItemsAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AttachOrderAdjustmentsAction;

class AttachRefundsAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'refunds';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Refund);
        $attributes = ['id' => data_get($list, 'id')];

        $refund = Refund::firstOrNew($attributes, $values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($refund);
        }

        $refund->save();

        foreach ($this->attachActions() as $attachAction) {
            (new $attachAction($list))->execute($refund);
        }
    }

    protected function associateActions(): array
    {
        return [];
    }

    protected function attachActions(): array
    {
        return [
            // AttachDutiesToRefundAction::class,
            AttachRefundDutiesAction::class,
            AttachRefundLineItemsAction::class,
            AttachTransactionsAction::class,
            AttachOrderAdjustmentsAction::class,
        ];
    }
}

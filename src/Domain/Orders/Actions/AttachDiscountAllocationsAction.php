<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\DiscountAllocation;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociateAmountSetAction;

class AttachDiscountAllocationsAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'discount_allocations';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new DiscountAllocation);
        $values['line_item_id'] = $this->model->id;
        $attributes = $values;

        $discountAllocation = DiscountAllocation::firstOrNew($attributes, $values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($discountAllocation);
        }

        $discountAllocation->save();
    }

    protected function associateActions(): array
    {
        return [
            AssociateAmountSetAction::class,
        ];
    }
}

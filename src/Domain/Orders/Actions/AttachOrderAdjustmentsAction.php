<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Transaction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\OrderAdjustment;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;

class AttachOrderAdjustmentsAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'order_adjustments';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new OrderAdjustment);
        $attributes = ['id' => data_get($list, 'id')];

        $orderAdjustment = OrderAdjustment::firstOrCreate($attributes, $values);

        $this->model->orderAdjustments()->attach($orderAdjustment);
    }
}

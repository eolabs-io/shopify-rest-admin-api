<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\RefundDuty;

class AttachRefundDutiesAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'refund_duties';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new RefundDuty);
        $values['refund_id'] = $this->model->id;
        $attributes = $values;

        RefundDuty::firstOrCreate($attributes, $values);
    }
}

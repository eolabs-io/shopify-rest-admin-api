<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\ShopifyRestAdminApi\Domain\ShippingFulfillment\Models\TrackingNumber;

class AttachTrackingNumbersAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'tracking_numbers';
    }

    protected function createItem($list)
    {
        $values = [
            'number' => $list,
            'fulfillment_id' => $this->model->id,
        ];

        $attributes = $values;

        TrackingNumber::firstOrCreate($attributes, $values);
    }
}

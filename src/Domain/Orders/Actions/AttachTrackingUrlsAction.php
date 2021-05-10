<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\ShopifyRestAdminApi\Domain\ShippingFulfillment\Models\TrackingUrl;

class AttachTrackingUrlsAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'tracking_urls';
    }

    protected function createItem($list)
    {
        $values = [
            'url' => $list,
            'fulfillment_id' => $this->model->id,
        ];
        $attributes = $values;

        TrackingUrl::firstOrCreate($attributes, $values);
    }
}

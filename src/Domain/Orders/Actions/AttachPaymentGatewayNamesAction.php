<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\PaymentGatewayName;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;

class AttachPaymentGatewayNamesAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'payment_gateway_names';
    }

    protected function createItem($name)
    {
        $values= [
            'order_id' => $this->model->id,
            'name' => $name,
        ];
        $attributes = $values;

        PaymentGatewayName::firstOrCreate($attributes, $values);
    }
}

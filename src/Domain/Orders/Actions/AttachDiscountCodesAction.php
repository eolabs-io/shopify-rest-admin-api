<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\DiscountCode;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;

class AttachDiscountCodesAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'discount_codes';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new DiscountCode);
        $values['order_id'] = $this->model->id;
        $attributes = $values;

        $discountCode = DiscountCode::firstOrCreate($attributes, $values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($discountCode);
        }

        $discountCode->save();
    }

    protected function associateActions(): array
    {
        return [];
    }
}

<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\DiscountApplication;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;

class AttachDiscountApplicationsAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'discount_applications';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new DiscountApplication);
        $values['order_id'] = $this->model->id;
        $attributes = $values;

        $discountApplication = DiscountApplication::firstOrCreate($attributes, $values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($discountApplication);
        }

        $discountApplication->save();
    }

    protected function associateActions(): array
    {
        return [];
    }
}

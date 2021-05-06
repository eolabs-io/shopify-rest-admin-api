<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Products\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\ProductOptionValue;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;

class AttachOptionValuesAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'values';
    }

    protected function createItem($list)
    {
        ProductOptionValue::create([
            'value' => $list,
            'product_option_id' => $this->model->id,
        ]);
    }
}

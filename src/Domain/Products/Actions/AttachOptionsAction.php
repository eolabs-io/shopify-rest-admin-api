<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Products\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\ProductOption;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Actions\AttachOptionValuesAction;

class AttachOptionsAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'options';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ProductOption);
        $attributes = ['id' => data_get($list, 'id')];

        $option = ProductOption::firstOrCreate($attributes, $values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($option);
        }

        $option->push();
    }

    protected function associateActions(): array
    {
        return [
            AttachOptionValuesAction::class,
        ];
    }
}

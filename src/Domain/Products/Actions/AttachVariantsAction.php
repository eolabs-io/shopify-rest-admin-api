<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Products\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\ProductVariant;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Actions\AttachPresentmentPricesAction;

class AttachVariantsAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'variants';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ProductVariant);
        $attributes = ['id' => data_get($list, 'id')];

        $variant = ProductVariant::updateOrCreate($attributes, $values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($variant);
        }

        $variant->push();
    }

    protected function associateActions(): array
    {
        return [
            AttachPresentmentPricesAction::class,
        ];
    }
}

<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Products\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\ProductImage;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;

class AttachImagesAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'images';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ProductImage);
        $attributes = ['id' => data_get($list, 'id')];

        $image = ProductImage::updateOrCreate($attributes, $values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($image);
        }

        $image->push();
    }

    protected function associateActions(): array
    {
        return [
            // AttachVariantIdsAction::class,
        ];
    }
}

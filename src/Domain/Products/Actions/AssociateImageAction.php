<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Products\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\ProductImage;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAssociateAction;

class AssociateImageAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'image';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ProductImage);
        $attributes = ['id' => data_get($list, 'id')];
        $image = ProductImage::updateOrCreate($attributes, $values);

        $this->model->image()->associate($image);
    }
}

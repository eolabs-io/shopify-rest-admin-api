<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Products\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\Product;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Actions\AttachImagesAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Actions\AssociateImageAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Actions\AttachVariantsAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Events\PersistedProductEvent;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;

class PersistProductAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'products';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new Product);
        $attributes = ['id' => data_get($list, 'id')];

        $product = Product::updateOrCreate($attributes, $values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($product);
        }

        $product->push();

        return $product;
    }

    protected function associateActions(): array
    {
        return [
            AttachVariantsAction::class,
            AttachOptionsAction::class,
            AttachImagesAction::class,
            AssociateImageAction::class,
        ];
    }

    public function getPersistedEvent()
    {
        return PersistedProductEvent::class;
    }
}

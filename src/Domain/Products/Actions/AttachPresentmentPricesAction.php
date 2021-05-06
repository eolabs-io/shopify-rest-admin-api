<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Products\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Models\PresentmentPrice;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Actions\AssociatePriceAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\ShopifyRestAdminApi\Domain\Products\Actions\AssociateCompareAtPriceAction;

class AttachPresentmentPricesAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'presentment_prices';
    }

    public function beforeCreateFromList()
    {
        // Remove if any PresentmentPrice
    }

    protected function createItem($list)
    {
        $presentmentPrice = new PresentmentPrice;
        $presentmentPrice->product_variant_id = $this->model->id;

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($presentmentPrice);
        }

        $presentmentPrice->push();
    }

    protected function associateActions(): array
    {
        return [
            AssociatePriceAction::class,
            AssociateCompareAtPriceAction::class,
        ];
    }
}

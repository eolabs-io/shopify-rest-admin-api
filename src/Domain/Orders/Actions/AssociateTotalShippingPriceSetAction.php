<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Money;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAssociateAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociateShopMoneyAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociatePresentmentMoneyAction;

class AssociateTotalShippingPriceSetAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'total_shipping_price_set';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Money);
        $totalShippingPriceSet = $this->model->totalShippingPriceSet->fill($values);

        foreach ($this->associateActions() as $attachActions) {
            (new $attachActions($list))->execute($totalShippingPriceSet);
        }

        $totalShippingPriceSet->save();

        $this->model->totalShippingPriceSet()->associate($totalShippingPriceSet);
    }

    protected function associateActions(): array
    {
        return [
            AssociateShopMoneyAction::class,
            AssociatePresentmentMoneyAction::class,
        ];
    }
}

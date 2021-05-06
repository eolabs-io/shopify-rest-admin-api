<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Money;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAssociateAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociateShopMoneyAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociatePresentmentMoneyAction;

class AssociateDiscountedPriceSetAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'discounted_price_set';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Money);
        $discountedPriceSet = $this->model->discountedPriceSet->fill($values);

        foreach ($this->associateActions() as $attachActions) {
            (new $attachActions($list))->execute($discountedPriceSet);
        }

        $discountedPriceSet->save();

        $this->model->discountedPriceSet()->associate($discountedPriceSet);
    }

    protected function associateActions(): array
    {
        return [
            AssociateShopMoneyAction::class,
            AssociatePresentmentMoneyAction::class,
        ];
    }
}

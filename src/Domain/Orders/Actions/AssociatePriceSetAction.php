<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Money;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAssociateAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociateShopMoneyAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociatePresentmentMoneyAction;

class AssociatePriceSetAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'price_set';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Money);
        $priceSet = $this->model->priceSet->fill($values);

        foreach ($this->associateActions() as $attachActions) {
            (new $attachActions($list))->execute($priceSet);
        }

        $priceSet->save();

        $this->model->priceSet()->associate($priceSet);
    }

    protected function associateActions(): array
    {
        return [
            AssociateShopMoneyAction::class,
            AssociatePresentmentMoneyAction::class,
        ];
    }
}

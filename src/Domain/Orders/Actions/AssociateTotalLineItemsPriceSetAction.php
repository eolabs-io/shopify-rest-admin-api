<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Money;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAssociateAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociateShopMoneyAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociatePresentmentMoneyAction;

class AssociateTotalLineItemsPriceSetAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'total_line_items_price_set';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Money);
        $totalLineItemsPriceSet = $this->model->totalLineItemsPriceSet->fill($values);

        foreach ($this->associateActions() as $attachActions) {
            (new $attachActions($list))->execute($totalLineItemsPriceSet);
        }

        $totalLineItemsPriceSet->save();

        $this->model->totalLineItemsPriceSet()->associate($totalLineItemsPriceSet);
    }

    protected function associateActions(): array
    {
        return [
            AssociateShopMoneyAction::class,
            AssociatePresentmentMoneyAction::class,
        ];
    }
}

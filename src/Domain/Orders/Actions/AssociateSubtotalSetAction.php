<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Money;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAssociateAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociateShopMoneyAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociatePresentmentMoneyAction;

class AssociateSubtotalSetAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'subtotal_set';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Money);
        $subtotalSet = $this->model->subtotalSet->fill($values);

        foreach ($this->associateActions() as $attachActions) {
            (new $attachActions($list))->execute($subtotalSet);
        }

        $subtotalSet->save();

        $this->model->subtotalSet()->associate($subtotalSet);
    }

    protected function associateActions(): array
    {
        return [
            AssociateShopMoneyAction::class,
            AssociatePresentmentMoneyAction::class,
        ];
    }
}

<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Money;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAssociateAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociateShopMoneyAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociatePresentmentMoneyAction;

class AssociateAmountSetAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'amount_set';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Money);
        $amountSet = $this->model->amountSet->fill($values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($amountSet);
        }

        $amountSet->save();

        $this->model->amountSet()->associate($amountSet);
    }

    protected function associateActions(): array
    {
        return [
            AssociateShopMoneyAction::class,
            AssociatePresentmentMoneyAction::class,
        ];
    }
}

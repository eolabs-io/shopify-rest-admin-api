<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAssociateAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\Price;

class AssociatePresentmentMoneyAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'presentment_money';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Price);
        $presentmentMoney = $this->model->presentmentMoney;
        $presentmentMoney->fill($values)->save();

        $this->model->presentmentMoney()->associate($presentmentMoney);
    }
}

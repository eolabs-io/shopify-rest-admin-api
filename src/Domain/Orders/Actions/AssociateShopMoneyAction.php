<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAssociateAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\Price;

class AssociateShopMoneyAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'shop_money';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Price);
        $shopMoney = $this->model->shopMoney;
        $shopMoney->fill($values)->save();

        $this->model->shopMoney()->associate($shopMoney);
    }
}

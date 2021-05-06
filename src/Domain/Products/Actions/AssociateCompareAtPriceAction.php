<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Products\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\Price;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAssociateAction;

class AssociateCompareAtPriceAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'compare_at_price';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Price);
        $price = Price::create($values);

        $this->model->compareAtPrice()->associate($price);
    }
}

<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\LineItem;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAssociateAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociatePriceSetAction;

class AssociateLineItemAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'line_item';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new LineItem);
        $lineItem = $this->model->lineItem->fill($values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($lineItem);
        }

        $lineItem->save();

        $this->model->lineItem()->associate($lineItem);
    }

    protected function associateActions(): array
    {
        return [
            AssociatePriceSetAction::class,
        ];
    }
}

<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Duty;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AttachTaxLinesAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociateShopMoneyAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociatePresentmentMoneyAction;

class AttachDutiesAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'duties';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Duty);
        $values['line_item_id'] = $this->model->id;
        $attributes = $values;

        $duty = Duty::firstOrNew($attributes, $values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($duty);
        }

        $duty->save();

        foreach ($this->attachActions() as $attachAction) {
            (new $attachAction($list))->execute($duty);
        }
    }

    protected function associateActions(): array
    {
        return [
            AssociateShopMoneyAction::class,
            AssociatePresentmentMoneyAction::class,
        ];
    }

    protected function attachActions(): array
    {
        return [
            AttachTaxLinesAction::class,
        ];
    }
}

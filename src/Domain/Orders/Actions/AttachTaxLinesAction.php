<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\TaxLine;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociatePriceSetAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;

class AttachTaxLinesAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'tax_lines';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new TaxLine);
        $attributes = $values;

        $taxLine = TaxLine::firstOrNew($attributes, $values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($taxLine);
        }

        $taxLine->save();

        $this->model->taxLines()->attach($taxLine);
    }

    protected function associateActions(): array
    {
        return [
            AssociatePriceSetAction::class,
        ];
    }
}

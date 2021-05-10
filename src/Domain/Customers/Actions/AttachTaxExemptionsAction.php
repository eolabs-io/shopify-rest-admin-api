<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Customers\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Models\TaxExemption;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;

class AttachTaxExemptionsAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'tax_exemptions';
    }

    public function beforeCreateFromList()
    {
        $this->model->taxExemptions()->detach();
    }

    protected function createItem($list)
    {
        $attributes = ['name' => $list];
        $values = $attributes;

        $taxExemption = TaxExemption::firstOrCreate($attributes, $values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($taxExemption);
        }

        $this->model->taxExemptions()->attach($taxExemption);
    }

    protected function associateActions(): array
    {
        return [];
    }
}

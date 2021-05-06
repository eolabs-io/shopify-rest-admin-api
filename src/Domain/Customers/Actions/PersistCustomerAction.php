<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Customers\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Models\Customer;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Actions\AttachAddressesAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Events\PersistedCustomerEvent;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Actions\AttachTaxExemptionsAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Actions\AssociateDefaultAddressAction;

class PersistCustomerAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'customers';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new Customer);
        $attributes = ['id' => data_get($list, 'id')];

        $customer = Customer::updateOrCreate($attributes, $values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($customer);
        }

        $customer->push();

        foreach ($this->attachActions() as $attachActions) {
            (new $attachActions($list))->execute($customer);
        }

        return $customer;
    }

    protected function associateActions(): array
    {
        return [
            AssociateDefaultAddressAction::class,
        ];
    }

    protected function attachActions(): array
    {
        return [
            AttachAddressesAction::class,
            AttachTaxExemptionsAction::class,
        ];
    }

    public function getPersistedEvent()
    {
        return PersistedCustomerEvent::class;
    }
}

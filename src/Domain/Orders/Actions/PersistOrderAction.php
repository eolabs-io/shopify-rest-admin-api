<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Order;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Events\PersistedOrderEvent;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AttachTaxLinesAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AttachLineItemsAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociateCustomerAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AttachFulfillmentsAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AttachDiscountCodesAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AttachShippingLinesAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociateTotalTaxSetAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AttachNoteAttributesAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociateClientDetailsAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociateTotalPriceSetAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociateBillingAddressAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociatePaymentDetailsAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociateShippingAddressAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociateSubtotalPriceSetAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AttachPaymentGatewayNamesAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociateTotalShippingPriceSetAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions\AssociateTotalLineItemsPriceSetAction;

class PersistOrderAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'orders';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new Order);
        $attributes = ['id' => data_get($list, 'id')];

        $order = Order::firstOrNew($attributes, $values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($order);
        }

        $order->push();

        foreach ($this->attachActions() as $attachActions) {
            (new $attachActions($list))->execute($order);
        }

        return $order;
    }

    protected function associateActions(): array
    {
        return [
            AssociateClientDetailsAction::class,
            AssociatePaymentDetailsAction::class,
            AssociateTotalLineItemsPriceSetAction::class,
            AssociateTotalDiscountsSetAction::class,
            AssociateTotalShippingPriceSetAction::class,
            AssociateSubtotalPriceSetAction::class,
            AssociateTotalPriceSetAction::class,
            AssociateTotalTaxSetAction::class,
            AssociateBillingAddressAction::class,
            AssociateShippingAddressAction::class,
            AssociateCustomerAction::class,
        ];
    }

    protected function attachActions(): array
    {
        return [
            AttachDiscountApplicationsAction::class,
            AttachDiscountCodesAction::class,
            AttachNoteAttributesAction::class,
            AttachPaymentGatewayNamesAction::class,
            AttachTaxLinesAction::class,
            AttachLineItemsAction::class,
            AttachFulfillmentsAction::class,
            AttachRefundsAction::class,
            AttachShippingLinesAction::class,
        ];
    }

    public function getPersistedEvent()
    {
        return PersistedOrderEvent::class;
    }
}

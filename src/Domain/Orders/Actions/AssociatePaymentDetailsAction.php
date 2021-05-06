<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\PaymentDetails;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAssociateAction;

class AssociatePaymentDetailsAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'payment_details';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new PaymentDetails);
        $paymentDetails = $this->model->paymentDetails;
        $paymentDetails->fill($values)->save();

        $this->model->paymentDetails()->associate($paymentDetails);
    }
}

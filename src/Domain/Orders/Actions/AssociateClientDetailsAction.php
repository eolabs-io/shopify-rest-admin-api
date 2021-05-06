<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\ClientDetails;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAssociateAction;

class AssociateClientDetailsAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'client_details';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ClientDetails);
        $clientDetails = $this->model->clientDetails;
        $clientDetails->fill($values)->save();

        $this->model->clientDetails()->associate($clientDetails);
    }
}

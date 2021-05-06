<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Transaction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;

class AttachTransactionsAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'transactions';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Transaction);
        $attributes = ['id' => data_get($list, 'id')];

        $transaction = Transaction::firstOrCreate($attributes, $values);

        $this->model->transactions()->attach($transaction);
    }
}

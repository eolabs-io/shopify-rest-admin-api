<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Actions;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\NoteAttribute;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\FormatsModelAttributes;

class AttachNoteAttributesAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'note_attributes';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new NoteAttribute);
        $values['order_id'] = $this->model->id;
        $attributes = $values;

        $noteAttribute = NoteAttribute::firstOrCreate($attributes, $values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($noteAttribute);
        }

        $noteAttribute->save();
    }

    protected function associateActions(): array
    {
        return [];
    }
}

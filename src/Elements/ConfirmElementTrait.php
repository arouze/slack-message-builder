<?php

namespace Arouze\SlackMessageBuilder\Elements;

use Arouze\SlackMessageBuilder\Objects\ConfirmationDialogObject;

trait ConfirmElementTrait
{
    protected ?ConfirmationDialogObject $confirm = null;

    public function setConfirm(?ConfirmationDialogObject $confirm): self
    {
        $this->confirm = $confirm;

        return $this;
    }

    private function handleConfirm(): self
    {
        if (!is_null($this->confirm)) {
            $this->block['confirm'] = $this->confirm->toArray();
        }

        return $this;
    }
}

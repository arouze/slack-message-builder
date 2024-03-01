<?php

namespace Arouze\SlackMessageBuilder\Elements;

use Arouze\SlackMessageBuilder\Objects\ConfirmationDialogObject;

interface ConfirmableElementInterface
{
    public function setConfirm(?ConfirmationDialogObject $confirm): self;
}

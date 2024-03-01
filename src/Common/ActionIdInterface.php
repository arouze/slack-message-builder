<?php

namespace Arouze\SlackMessageBuilder\Common;

interface ActionIdInterface
{
    public const ACTION_ID_LENGTH = 255;

    public function setActionId(?string $actionId): self;

    public function handleActionId(): self;
}

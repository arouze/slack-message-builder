<?php

namespace Arouze\SlackMessageBuilder\Common;

use Arouze\SlackMessageBuilder\Exceptions\TooLongTextException;

trait ActionIdTrait
{
    protected ?string $actionId = null;

    public function setActionId(?string $actionId): self
    {
        if (strlen($actionId) > ActionIdInterface::ACTION_ID_LENGTH) {
            throw new TooLongTextException(strlen($actionId), ActionIdInterface::ACTION_ID_LENGTH);
        }

        $this->actionId = $actionId;

        return $this;
    }

    public function handleActionId(): self
    {
        if (!is_null($this->actionId)) {
            $this->block['action_id'] = $this->actionId;
        }

        return $this;
    }
}

<?php

namespace Arouze\SlackMessageBuilder\Objects;

class WorkflowObject implements ObjectInterface
{
    // @doc : https://api.slack.com/reference/block-kit/composition-objects#workflow
    private array $block = [];

    private TriggerObject $trigger;

    public function setTrigger(TriggerObject $trigger): self
    {
        $this->trigger = $trigger;

        return $this;
    }

    private function handleTrigger(): void
    {
        $this->block['trigger'] = $this->trigger->toArray();
    }

    public function toArray(): array
    {
        $this->handleTrigger();

        return $this->block;
    }
}

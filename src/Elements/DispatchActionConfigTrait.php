<?php

namespace Arouze\SlackMessageBuilder\Elements;

use Arouze\Tests\Objects\DispatchActionConfigurationObject;

trait DispatchActionConfigTrait
{
    private ?DispatchActionConfigurationObject $dispatchActionConfig = null;

    public function setDispatchActionConfig(?DispatchActionConfigurationObject $dispatchActionConfig): self
    {
        $this->dispatchActionConfig = $dispatchActionConfig;

        return $this;
    }

    private function handleDispatchActionConfig(): self
    {
        if (!is_null($this->dispatchActionConfig)) {
            $this->block['dispatch_action_config'] = $this->dispatchActionConfig->toArray();
        }

        return $this;
    }
}
